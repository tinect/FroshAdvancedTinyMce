{block name="backend/base/header/javascript" append}
<script type="text/javascript">
    Shopware.form.field.TinyMCE.setGlobalSettings({
{if $tinyMceConfig->get('useThemeAdvancedButtons')}
        theme_advanced_buttons1: "{$tinyMceConfig->get('themeAdvancedButtons1')|strip|replace:" ":""|escape:javascript}",
        theme_advanced_buttons2: "{$tinyMceConfig->get('themeAdvancedButtons2')|strip|replace:" ":""|escape:javascript}",
        theme_advanced_buttons3: "{$tinyMceConfig->get('themeAdvancedButtons3')|strip|replace:" ":""|escape:javascript}",
        theme_advanced_buttons4: "{$tinyMceConfig->get('themeAdvancedButtons4')|strip|replace:" ":""|escape:javascript}",
{/if}
{if $tinyMceConfig->get('usePlugins')}
        plugins: "{$tinyMceConfig->get('plugins')|strip|replace:" ":""|escape:javascript}",
{/if}
{if $tinyMceConfig->get('useExtendedValidElements')}
        extended_valid_elements : "{$tinyMceConfig->get('extendedValidElements')|strip|replace:" ":""|escape:javascript}",
{/if}
{if $tinyMceConfig->get('useHtml5Schema')}
        schema: "html5",
{/if}
{if $tinyMceConfig->get('useContentCss')}
        content_css: "{link file=$tinyMceConfig->get('contentCss') fullPath}?_dc=" + new Date().getTime(),
{/if}
{if $tinyMceConfig->get('useStyleFormats')}
        style_formats: [
            {$tinyMceConfig->get('styleFormats')}
        ],
{/if}
        skin_variant : "{$tinyMceConfig->get('skinVariant', 'shopware')}",
        template_external_list_url: "{url controller=tinyMce action=getRawTemplateList}"
    });
</script>
{/block}