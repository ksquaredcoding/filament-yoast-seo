import { helpers } from 'yoastseo'
import isObject from 'lodash/isObject'
import forEach from 'lodash/forEach'
import filter from 'lodash/filter'
import SEOAssessor from "yoastseo/src/seoAssessor";
import Jed from "jed";
import { Paper, ContentAssessor } from "yoastseo";

class Presenter {

    getScoresAsHTML(h, data) {
        return h('div', { className: 'yoast' },
            h('h3', { className: 'yoast__heading' }, 'SEO'),
            h('ul', { className: 'yoast__items' },
                this.getScoreItemsAsHTML(h, data.seo)
            ),
            h('h3', { className: 'yoast__heading' }, 'Content'),
            h('ul', { className: 'yoast__items yoast__items--bottom' },
                this.getScoreItemsAsHTML(h, data.content)
            )
        )
    }

    getScoreItemsAsHTML(h, items) {
        return items.map(item => this.getScoreItemAsHTML(h, item))
    }

    getScoreItemAsHTML(h, item) {
        return h('li', { className: `yoast__item yoast__item--${item.rating}` }, item.text.replace(/<(?:.|\n)*?>/gm, ''))
    }

    getScores(assessor) {
        const scores = []

        forEach(this.getScoresWithRatings(assessor), (item, key) =>
            scores.push(this.addRating(item))
        )

        return scores
    }

    addRating(item) {
        return {
            rating: item.rating,
            text: item.text,
            identifier: item.getIdentifier()
        }
    }

    getScoresWithRatings(assessor) {
        const scores = assessor.getValidResults().map(r => {
            if (!isObject(r) || !r.getIdentifier()) {
                return ``;
            }
            r.rating = helpers.scoreToRating(r.score)
            return r
        })

        return filter(scores, r => r !== ``);
    }
}

export default function yoastSeoManager() {
    return {
        entity: {
            default: null,
            type: Object,
        },
        states: ["Problems", "Improvements", "Good results"],
        changes: false,
        text: "",
        keyword: "",
        title: "",
        description: "",
        url: "",
        titleWidth: "",
        en_locale: "",
        permalink: "",
        synonyms: "",
        seo: [],
        content: [],
        seo_score: null,
        readability_score: null,
        
        init: function() {
            this.setFields();
            this.yoastFormSubmit();
            this.setObserver();
            this.titleWidth = this.getPixelWidth("title-width");
        },

        setObserver() {
            const options = {
            rootMargin: "0px 0px",
            threshold: 0,
            };
            let loadSeoResults = (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting && this.changes) {
                this.setFields();
                this.yoastFormSubmit();
                this.changes = false;
                }
            });
            };
            let observer = new IntersectionObserver(loadSeoResults, options);
            let target = document.getElementById("seo-assessment");
            observer.observe(target);
        },
        setFields() {
            this.text = this.entity.body;
            this.keyword =
            this.entity.permalink.seo.keyword !== undefined
                ? this.entity.permalink.seo.keyword
                : "";
            this.title =
            this.entity.permalink.seo.title !== undefined
                ? this.entity.permalink.seo.title
                : "";
            this.description =
            this.entity.permalink.seo.description !== undefined
                ? this.entity.permalink.seo.description
                : "";
            this.url =
            location.protocol +
            "//" +
            window.location.hostname +
            "/" +
            this.entity.permalink.slug;
            this.en_locale = this.entity.locale;
            this.permalink = this.entity.permalink.slug;
            this.seo_score =
            this.entity.permalink.seo.seo_score !== undefined
                ? this.entity.permalink.seo.seo_score
                : "";
            this.readability_score =
            this.entity.permalink.seo.readability_score !== undefined
                ? this.entity.permalink.seo.readability_score
                : "";
            this.titleWidth = 0;
        },
        filterRating(resultArray, rating) {
            return resultArray.filter((item) => {
            return item.rating === rating;
            });
        },
        getPixelWidth(id) {
            return document.getElementById(id)?.offsetWidth;
        },
        yoastFormSubmit() {
            const paper = new Paper(this.text, {
            keyword: this.keyword,
            title: this.title,
            description: this.description,
            url: this.permalink, // The slug
            // metaDescription: this.metaDescription,
            titleWidth: this.titleWidth
                ? this.titleWidth
                : this.getPixelWidth("title-width"),
            locale: this.en_locale,
            permalink: this.url, // The base url + slug
            });
            const contentAssessor = new ContentAssessor(this.i18n());
            const seoAssessor = new SEOAssessor(this.i18n());
            contentAssessor.assess(paper);
            seoAssessor.assess(paper);
            const final_scores = this.getScores(seoAssessor, contentAssessor);
            this.seo = final_scores.seo;
            this.content = final_scores.content;
            this.seo_score = this.getAverageScore(this.seo);
            this.readability_score = this.getAverageScore(this.content);
        },
        getScores(seoAssessor, contentAssessor) {
            return {
            seo: new Presenter().getScoresWithRatings(seoAssessor),
            content: new Presenter().getScoresWithRatings(contentAssessor),
            };
        },
        getScoresAsHTML(scores) {
            return new Presenter().getScoresAsHTML(h, scores);
        },
        getAverageScore(assessmentArray) {
            let totalScore = 0;
            assessmentArray.forEach((element) => {
            totalScore += element.score;
            });
            return Math.floor(totalScore / assessmentArray.length);
        },
        i18n() {
            return new Jed({
            domain: `js-text-analysis`,
            locale_data: {
                "js-text-analysis": { "": {} },
            },
            });
        },
        boldString(str, find) {
            var re = new RegExp(find, "gi");
            return str.replace(re, "<b>" + find + "</b>");
        },
        scoreClass(score) {
            let cssClass = "null";
            if (score > 7) {
            cssClass = "good";
            } else if (score > 4) {
            cssClass = "ok";
            } else if (score) {
            cssClass = "bad";
            }
            return cssClass;
        },
        $watch: {
            $data: {
                handler: function () {
                this.changes = true;
                },
                deep: true,
            },
        },
    }
}