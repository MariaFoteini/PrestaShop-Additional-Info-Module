{*
*  @author      Maria Foteini Troupi
*}

<script>
    window._AdditionalInfo = (function () {
        function modifyProductFields() {
            var submitButton = document.getElementById("additional-info-save");
            submitButton.setAttribute("disabled", "disabled");

            var submitButtonInnerHtml = submitButton.innerHTML; 

            var loadingIconInnerHtml = '<i class="process-icon-loading"></i>';
            submitButton.innerHTML = loadingIconInnerHtml;

            document.getElementById("alert-additional-info-danger").style.display = "none";
            
            var languageId = {$language_id};
            var productId = {$product_id};
            $.ajax({
                type: "POST",
                url: '{$controller_link}',
                data: {
                    material_and_care: $.trim($("#material_and_care").val()),
                    sustainability: $.trim($("#sustainability").val()),
                    point_of_origin: $.trim($("#point_of_origin").val()),
                    language_id: languageId,
                    product_id: productId
                },
                dataType: 'json',
            }).done(function (response) {
                if(response.result === false){
                    document.getElementById("alert-additional-info-danger").style.display = "block";
                }
            }).fail(function(){
                document.getElementById("alert-additional-info-danger").style.display = "block";
            }).always(function(){
                submitButton.removeAttribute("disabled");
                submitButton.innerHTML = submitButtonInnerHtml;
            });
        }
        return { modifyProductFields }
    })();
</script>

<div class="panel product-tab">
    <h4 class="panel-heading tab">{l s='Additional Information'}</h4>
    <div class="alert alert-danger" id="alert-additional-info-danger"  style="display:none">
        Something went wrong! Retry later!
    </div>
    <div class="form-group">
        <label class="control-label col-lg-2" for="description_short_{$id_lang}">
            <span class="label-tooltip" data-toggle="tooltip"
                title="{l s='Appears in the product list(s), and at the top of the product page.'}">
                {l s='Material & Care'}
            </span>
        </label>
        <textarea class="col-lg-9" id="material_and_care" name="material_and_care" rows="5"
            cols="50">{$additional_fields['material_and_care']|escape:'html'}</textarea>
    </div>
    <div class="form-group">
        <label class="control-label col-lg-2" for="description_{$id_lang}">
            <span class="label-tooltip" data-toggle="tooltip" title="{l s='Appears in the body of the product page.'}">
                {l s='Sustainability'}
            </span>
        </label>
        <textarea class="col-lg-9" id="sustainability" name="sustainability" rows="5"
            cols="50">{$additional_fields['sustainability']|escape:'html'}</textarea>
    </div>
    <div class="form-group">
        <label class="control-label col-lg-2" for="description_{$id_lang}">
            <span class="label-tooltip" data-toggle="tooltip" title="{l s='Appears in the body of the product page.'}">
                {l s='Point of Origin'}
            </span>
        </label>
        <textarea class="col-lg-9" id="point_of_origin" name="point_of_origin" rows="5"
            cols="50">{$additional_fields['point_of_origin']|escape:'html'}</textarea>
    </div>
    <div class="panel-footer">
        <a href="{$link->getAdminLink('AdminProducts')|escape:'html':'UTF-8'}{if isset($smarty.request.page) && $smarty.request.page > 1}&amp;submitFilterproduct={$smarty.request.page|intval}{/if}"
            class="btn btn-default"><i class="process-icon-cancel"></i> {l s='Cancel'}</a>
        <button class="btn btn-default pull-right" id="additional-info-save" type="button" onclick="window._AdditionalInfo.modifyProductFields()">{l s='Save'}</button>
    </div>
</div>