{var $categories = get_the_terms($post->id, 'ait-items')}

{var $meta = $post->meta('item-data')}

{var $dbFeatured = get_post_meta($post->id, '_ait-item_item-featured', true)}
{var $isFeatured = $dbFeatured != "" ? filter_var($dbFeatured, FILTER_VALIDATE_BOOLEAN) : false}

{var $noFeatured = $options->theme->item->noFeatured}

<div n:class='item-container, $isFeatured ? "item-featured", defined("AIT_REVIEWS_ENABLED") ? reviews-enabled'>
    <div class="content">

        <div class="item-image">
            <a class="main-link" href="{$post->permalink}">
                <span>{__ 'View Detail'}</span>
                {if $post->image}
                <img src="{imageUrl $post->imageUrl, width => 200, height => 240, crop => 1}" alt="Featured">
                {else}
                <img src="{imageUrl $noFeatured, width => 200, height => 240, crop => 1}" alt="Featured">
                {/if}
            </a>
            {if defined('AIT_REVIEWS_ENABLED')}
                {includePart "portal/parts/carousel-reviews-stars", item => $post, showCount => false}
            {/if}
        </div>
        <div class="item-data">
            <div class="item-header">
                <div class="item-title-wrap">
                    <div class="item-title">
                        <a href="{$post->permalink}">
                            <h3>{!$post->title}</h3>
                        </a>
                    </div>
                    <span class="subtitle">{AitLangs::getCurrentLocaleText($meta->subtitle)}</span>
                </div>

                {var $target = $meta->socialIconsOpenInNewWindow ? 'target="_blank"' : ""}
                {if $meta->displaySocialIcons}

                        <div class="social-icons-container">
                            <div class="content">
                                {if count($meta->socialIcons) > 0}
                                    <ul><!--
                                    {foreach $meta->socialIcons as $icon}
                                    --><li>
                                            <a href="{!$icon['link']}" {!$target}>
                                                <i class="fa {$icon['icon']}"></i>
                                            </a>
                                        </li><!--
                                    {/foreach}
                                    --></ul>
                                {/if}
                            </div>
                        </div>

                {/if}

                {if count($categories) > 0}
                <div class="item-categories">
                    {foreach $categories as $category}
                        {var $catLink = get_term_link($category)}
                        <a href="{$catLink}"><span class="item-category">{!$category->name}</span></a>
                    {/foreach}
                </div>
                {/if}
            </div>
            <div class="item-body">
                <div class="entry-content">
                    <p class="txtrows-4">
                        {if $post->hasExcerpt}
                            {!$post->excerpt|striptags|trim|truncate: 250}
                        {else}
                            {!$post->content|striptags|trim|truncate: 250}
                        {/if}
                    </p>
                </div>
            </div>
            <div class="item-footer">
                {if $meta->map['address']}
                <div class="item-address">
                    <span class="label">{__ 'Address:'}</span>
                    <span class="value">{$meta->map['address']}</span>
                </div>
                {/if}

                {if $meta->web}
                <div class="item-web">
                    <span class="label">{__ 'Web:'}</span>
                    <span class="value"><a href="{!$meta->web}" target="_blank">{if $meta->webLinkLabel}{$meta->webLinkLabel}{else}{$meta->web}{/if}</a></span>
                </div>
                {/if}

                {if !is_array($meta->features)}
                    {var $meta->features = array()}
                {/if}

                {if defined('AIT_ADVANCED_FILTERS_ENABLED')}
                    {var $item_meta_filters = $post->meta('filters-options')}
                    {if is_array($item_meta_filters->filters) && count($item_meta_filters->filters) > 0}
                        {var $custom_features = array()}
                        {foreach $item_meta_filters->filters as $filter_id}
                            {var $filter_data = get_term($filter_id, 'ait-items_filters', "OBJECT")}
                            {if $filter_data}
                                {var $filter_meta = get_option( "ait-items_filters_category_".$filter_data->term_id )}
                                {var $filter_icon = isset($filter_meta['icon']) ? $filter_meta['icon'] : ""}
                                {? array_push($meta->features, array(
                                    "icon" => $filter_icon,
                                    "text" => $filter_data->name,
                                    "desc" => $filter_data->description
                                ))}
                            {/if}
                        {/foreach}
                    {/if}
                {/if}


                {if is_array($meta->features) && count($meta->features) > 0}
                <div class="item-features">
                    <div class="label">{__ 'Features:'}</div>
                    <div class="value">
                        <ul class="item-filters">
                        {foreach $meta->features as $filter}
                            {var $imageClass = $filter['icon'] != '' ? 'has-image' : ''}
                            {var $textClass = $filter['text'] != '' ? 'has-text' : ''}

                            <li class="item-filter {$imageClass} {$textClass}">
                                {if $filter['icon'] != ''}
                                <i class="fa {$filter['icon']}"></i>
                                {/if}
                                <span class="filter-hover">
                                    {!$filter['text']}
                                </span>

                            </li>
                        {/foreach}
                        </ul>
                    </div>
                </div>
                {/if}


            </div>
        </div>
    </div>

</div>