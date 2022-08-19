<?php

/**
 * Templates Keywords Filter
 */
?>
<# if ( ! _.isEmpty( keywords ) ) { #>
    <label><?php echo __('Filter by', 'master-addons' ); ?></label>
    <select id="elementor-template-library-filter-subtype" class="elementor-template-library-filter-select ma-el-library-keywords" data-elementor-filter="subtype">
        <option value=""><?php echo __('All Widgets/Addons', 'master-addons' ); ?></option>
        <# _.each( keywords, function( title, slug ) { #>
            <option value="{{ slug }}">{{ title }}</option>
            <# } ); #>
    </select>
    <# } #>
