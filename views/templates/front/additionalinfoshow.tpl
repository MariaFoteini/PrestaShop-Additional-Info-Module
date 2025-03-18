{*
*  @author      Maria Foteini Troupi
*}
{if $additional_fields['material_and_care'] || $additional_fields['sustainability'] || $additional_fields['point_of_origin']}
<div class="page-product-box">
    <h3 class="page-product-heading">Additional information</h3>
</div>
<div class="container rte">
    <div class="row clearfix">
        {if $additional_fields['material_and_care']}
        <div class="{$grid_col_class} additional-info">
            <label>Materials & Care</label>
            <img src="{$img_path}/mat.svg" class="img-responsive" alt="materials">
            <p>{$additional_fields['material_and_care']|escape:'html'}</p>
        </div>
        {/if}
        {if $additional_fields['sustainability']}
        <div class="{$grid_col_class} additional-info">
            <label>Sustainability</label>
            <img src="{$img_path}/sus.svg" class="img-responsive" alt="sustainability">
            <p>{$additional_fields['sustainability']|escape:'html'}</p>
        </div>
        {/if}
        {if $additional_fields['point_of_origin']}
        <div class="{$grid_col_class} additional-info">
            <label>Points of origin</label>
            <img src="{$img_path}/map.svg" class="img-responsive" alt="map">
            <p>{$additional_fields['point_of_origin']|escape:'html'}</p>
        </div>
        {/if}
    </div>
</div>
{/if}