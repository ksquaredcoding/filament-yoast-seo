@php
use Filament\Support\Facades\FilamentAsset;
@endphp
<x-dynamic-component
:component="$getFieldWrapperView()"
:field="$field"
>
<!-- Interact with the `state` property in Alpine.js -->
<div class="container" id="seo-assessment"
ax-load
ax-load-src="{{ FilamentAsset::getAlpineComponentSrc('filament-yoast-seo', 'outreach/filament-yoast-seo') }}"
x-data="yoastSeoManager()"
>
    <div class="">
    <div class="py-3">
        <h4>SEO & Content Assessment</h4>

        <hr />

        <div class="serp-result">
        <div class="resultTitle">
            <span id="title-width" x-text="boldString(title, keyword)"></span>
        </div>
        <div class="resultUrl">
            <span x-html="boldString(url, keyword)"></span>
        </div>
        <div class="resultDescription">
            <span
            id="description-width"
            x-html="boldString(description, keyword)"
            ></span>
        </div>
        </div>
    </div>

    <div x-show="seo.length">
        <div class="">
        <hr />
        </div>

        <div class="mb-3">
        <h5>
            <svg
            class="score seo-score-icon seo-score-text"
            :class="scoreClass(seo_score)"
            aria-hidden="true"
            role="img"
            focusable="false"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 1792 1792"
            fill="#dc3232"
            >
            <path
                d="M1664 896q0 209-103 385.5t-279.5 279.5-385.5 103-385.5-103-279.5-279.5-103-385.5 103-385.5 279.5-279.5 385.5-103 385.5 103 279.5 279.5 103 385.5z"
            />
            </svg>
            <b>SEO</b>
        </h5>
        <input x-model="seo_score" name="seo_score" class="hidden" />
        <ul uk-accordion>
            <template x-for="(rating, index) in ['bad', 'ok', 'good']" :key="rating">
                <li x-data="{ selected: null }">
                    <a class="uk-accordion-title" href="#" x-text="states[index] + ' (' + filterRating(seo, rating).length + ')'" @click="selected = selected === index ? null : index">
                    </a>
                    <div x-show="selected === index">
                        <ul class="bulleted-list">
                            <template x-for="(item, index) in filterRating(seo, rating)">
                                <li
                                    class="p-2 pl-0 "
                                    :key="index"
                                >
                                    <svg
                                    class="score seo-score-icon seo-score-text"
                                    :class="item.rating"
                                    aria-hidden="true"
                                    role="img"
                                    focusable="false"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 1792 1792"
                                    fill="#dc3232"
                                    >
                                    <path
                                        d="M1664 896q0 209-103 385.5t-279.5 279.5-385.5 103-385.5-103-279.5-279.5-103-385.5 103-385.5 279.5-279.5 385.5-103 385.5 103 279.5 279.5 103 385.5z"
                                    />
                                    </svg>
                                    <p x-html="item.text"></p>
                                </li>
                            </template>
                        </ul>
                    </div>
                </li>
            </template>
        </ul>
        </div>
    </div>

        <div x-show="content.length">
            <div class="">
                <hr />
            </div>
            <div class="mb-3">
                <h5>
                    <svg
                    class="score seo-score-icon seo-score-text"
                    :class="scoreClass(readability_score)"
                    aria-hidden="true"
                    role="img"
                    focusable="false"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 1792 1792"
                    fill="#dc3232"
                    >
                    <path
                        d="M1664 896q0 209-103 385.5t-279.5 279.5-385.5 103-385.5-103-279.5-279.5-103-385.5 103-385.5 279.5-279.5 385.5-103 385.5 103 279.5 279.5 103 385.5z"
                    />
                    </svg>
                    <b>Content</b>
                </h5>
                <input
                    x-model="readability_score"
                    name="readability_score"
                    class="hidden"
                />

                <ul class="text-black">
                    <template x-for="(rating, index) in ['bad', 'ok', 'good']" :key="rating">
                        <li x-data="{ selected: null }">
                            <a href="#" class="text-md hover:text-gray-500 focus:text-gray-500" x-text="states[index] + ' (' + filterRating(content, rating).length + ')'" @click="selected = selected === index ? null : index">
                            </a>
                            <div x-show="selected === index">
                                <ul class="bulleted-list">
                                    <template x-for="(item, index) in filterRating(content, rating)">
                                        <li
                                            class="p-2 pl-0 "
                                            :key="index"
                                        >
                                            <svg
                                            class="score seo-score-icon seo-score-text"
                                            :class="item.rating"
                                            aria-hidden="true"
                                            role="img"
                                            focusable="false"
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 1792 1792"
                                            fill="#dc3232"
                                            >
                                            <path
                                                d="M1664 896q0 209-103 385.5t-279.5 279.5-385.5 103-385.5-103-279.5-279.5-103-385.5 103-385.5 279.5-279.5 385.5-103 385.5 103 279.5 279.5 103 385.5z"
                                            />
                                            </svg>
                                            <p x-html="item.text"></p>
                                        </li>
                                    </template>
                                </ul>
                            </div>
                        </li>
                    </template>
                </ul>
            </div>
        </div>
    </div>
</div>
</x-dynamic-component>

<style scoped>
    hr {
    margin-top: 1rem;
    margin-bottom: 1rem;
    border: 0;
    border-top: 1px solid rgba(0, 0, 0, 0.1);
    }
    .serp-result {
    font-family: arial, sans-serif;
    }
    .resultTitle {
    text-decoration: none;
    color: #1e0fbe;
    font-size: 18px !important;
    line-height: 18px !important;
    }
    .resultUrl {
    padding: 4px 0px 2px;
    color: rgb(0, 102, 33);
    margin-bottom: 1px;
    font-size: 13px;
    line-height: 16px;
    }
    .resultDescription {
    font-size: 13px;
    color: #545454;
    line-height: 1.4;
    word-wrap: break-word;
    white-space: pre-wrap;
    }
    .input.is-danger:focus {
    border-color: #dc3545 !important;
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px #dc3545 !important;
    outline: 0 none;
    }
    .input.is-danger {
    border-color: #dc3545 !important;
    }
    .help.is-danger {
    color: #a94442;
    }
    .uk-accordion-title {
    font-size: 1rem;
    }
    ul {
    margin: 0;
    padding: 0;
    list-style: none;
    }
    .bulleted-list li {
    display: flex;
    align-items: flex-start;
    padding-left: 20px !important;
    }
    .seo-score-icon.bad {
    fill: #dc3232;
    }
    .seo-score-icon.good {
    fill: #7ad03a;
    }
    .seo-score-icon.ok {
    fill: #ee7c1b;
    }
    .seo-score-icon.null {
    fill: gray;
    }
    .seo-score-icon {
    vertical-align: baseline;
    width: 13px;
    height: 13px;
    flex: none;
    margin-top: 6px;
    position: relative;
    left: -1px;
    }
    .bulleted-list p {
    margin: 0 8px 0 11px;
    -webkit-flex: 1 1 auto;
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    }
</style>