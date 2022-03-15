<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main,
    Bitrix\Main\Localization\Loc;

/**
 * @var array $arParams
 * @var array $arResult
 * @var CMain $APPLICATION
 * @var CUser $USER
 * @var SaleOrderAjax $component
 * @var string $templateFolder
 */

$context = Main\Application::getInstance()->getContext();
$request = $context->getRequest();
if (empty($arParams['TEMPLATE_THEME']))
{
  $arParams['TEMPLATE_THEME'] = Main\ModuleManager::isModuleInstalled('bitrix.eshop') ? 'site' : 'blue';
}

if ($arParams['TEMPLATE_THEME'] === 'site')
{
  $templateId = Main\Config\Option::get('main', 'wizard_template_id', 'eshop_bootstrap', $component->getSiteId());
  $templateId = preg_match('/^eshop_adapt/', $templateId) ? 'eshop_adapt' : $templateId;
  $arParams['TEMPLATE_THEME'] = Main\Config\Option::get('main', 'wizard_'.$templateId.'_theme_id', 'blue', $component->getSiteId());
}

if (!empty($arParams['TEMPLATE_THEME']))
{
  if (!is_file(Main\Application::getDocumentRoot().'/bitrix/css/main/themes/'.$arParams['TEMPLATE_THEME'].'/style.css'))
  {
    $arParams['TEMPLATE_THEME'] = 'blue';
  }
}

$arParams['ALLOW_USER_PROFILES'] = $arParams['ALLOW_USER_PROFILES'] === 'Y' ? 'Y' : 'N';
$arParams['SKIP_USELESS_BLOCK'] = $arParams['SKIP_USELESS_BLOCK'] === 'N' ? 'N' : 'Y';

if (!isset($arParams['SHOW_ORDER_BUTTON']))
{
  $arParams['SHOW_ORDER_BUTTON'] = 'final_step';
}

$arParams['HIDE_ORDER_DESCRIPTION'] = isset($arParams['HIDE_ORDER_DESCRIPTION']) && $arParams['HIDE_ORDER_DESCRIPTION'] === 'Y' ? 'Y' : 'N';
$arParams['SHOW_TOTAL_ORDER_BUTTON'] = $arParams['SHOW_TOTAL_ORDER_BUTTON'] === 'Y' ? 'Y' : 'N';
$arParams['SHOW_PAY_SYSTEM_LIST_NAMES'] = $arParams['SHOW_PAY_SYSTEM_LIST_NAMES'] === 'N' ? 'N' : 'Y';
$arParams['SHOW_PAY_SYSTEM_INFO_NAME'] = $arParams['SHOW_PAY_SYSTEM_INFO_NAME'] === 'N' ? 'N' : 'Y';
$arParams['SHOW_DELIVERY_LIST_NAMES'] = $arParams['SHOW_DELIVERY_LIST_NAMES'] === 'N' ? 'N' : 'Y';
$arParams['SHOW_DELIVERY_INFO_NAME'] = $arParams['SHOW_DELIVERY_INFO_NAME'] === 'N' ? 'N' : 'Y';
$arParams['SHOW_DELIVERY_PARENT_NAMES'] = $arParams['SHOW_DELIVERY_PARENT_NAMES'] === 'N' ? 'N' : 'Y';
$arParams['SHOW_STORES_IMAGES'] = $arParams['SHOW_STORES_IMAGES'] === 'N' ? 'N' : 'Y';

if (!isset($arParams['BASKET_POSITION']) || !in_array($arParams['BASKET_POSITION'], array('before', 'after')))
{
  $arParams['BASKET_POSITION'] = 'after';
}

$arParams['EMPTY_BASKET_HINT_PATH'] = isset($arParams['EMPTY_BASKET_HINT_PATH']) ? (string)$arParams['EMPTY_BASKET_HINT_PATH'] : '/';
$arParams['SHOW_BASKET_HEADERS'] = $arParams['SHOW_BASKET_HEADERS'] === 'Y' ? 'Y' : 'N';
$arParams['HIDE_DETAIL_PAGE_URL'] = isset($arParams['HIDE_DETAIL_PAGE_URL']) && $arParams['HIDE_DETAIL_PAGE_URL'] === 'Y' ? 'Y' : 'N';
$arParams['DELIVERY_FADE_EXTRA_SERVICES'] = $arParams['DELIVERY_FADE_EXTRA_SERVICES'] === 'Y' ? 'Y' : 'N';
$arParams['SHOW_COUPONS_BASKET'] = $arParams['SHOW_COUPONS_BASKET'] === 'N' ? 'N' : 'Y';
$arParams['SHOW_COUPONS_DELIVERY'] = $arParams['SHOW_COUPONS_DELIVERY'] === 'N' ? 'N' : 'Y';
$arParams['SHOW_COUPONS_PAY_SYSTEM'] = $arParams['SHOW_COUPONS_PAY_SYSTEM'] === 'Y' ? 'Y' : 'N';
$arParams['SHOW_NEAREST_PICKUP'] = $arParams['SHOW_NEAREST_PICKUP'] === 'Y' ? 'Y' : 'N';
$arParams['DELIVERIES_PER_PAGE'] = isset($arParams['DELIVERIES_PER_PAGE']) ? intval($arParams['DELIVERIES_PER_PAGE']) : 9;
$arParams['PAY_SYSTEMS_PER_PAGE'] = isset($arParams['PAY_SYSTEMS_PER_PAGE']) ? intval($arParams['PAY_SYSTEMS_PER_PAGE']) : 9;
$arParams['PICKUPS_PER_PAGE'] = isset($arParams['PICKUPS_PER_PAGE']) ? intval($arParams['PICKUPS_PER_PAGE']) : 5;
$arParams['SHOW_PICKUP_MAP'] = $arParams['SHOW_PICKUP_MAP'] === 'N' ? 'N' : 'Y';
$arParams['SHOW_MAP_IN_PROPS'] = $arParams['SHOW_MAP_IN_PROPS'] === 'Y' ? 'Y' : 'N';
$arParams['USE_YM_GOALS'] = $arParams['USE_YM_GOALS'] === 'Y' ? 'Y' : 'N';
$arParams['USE_ENHANCED_ECOMMERCE'] = isset($arParams['USE_ENHANCED_ECOMMERCE']) && $arParams['USE_ENHANCED_ECOMMERCE'] === 'Y' ? 'Y' : 'N';
$arParams['DATA_LAYER_NAME'] = isset($arParams['DATA_LAYER_NAME']) ? trim($arParams['DATA_LAYER_NAME']) : 'dataLayer';
$arParams['BRAND_PROPERTY'] = isset($arParams['BRAND_PROPERTY']) ? trim($arParams['BRAND_PROPERTY']) : '';

$useDefaultMessages = !isset($arParams['USE_CUSTOM_MAIN_MESSAGES']) || $arParams['USE_CUSTOM_MAIN_MESSAGES'] != 'Y';

if ($useDefaultMessages || !isset($arParams['MESS_AUTH_BLOCK_NAME']))
{
  $arParams['MESS_AUTH_BLOCK_NAME'] = Loc::getMessage('AUTH_BLOCK_NAME_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_REG_BLOCK_NAME']))
{
  $arParams['MESS_REG_BLOCK_NAME'] = Loc::getMessage('REG_BLOCK_NAME_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_BASKET_BLOCK_NAME']))
{
  $arParams['MESS_BASKET_BLOCK_NAME'] = Loc::getMessage('BASKET_BLOCK_NAME_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_REGION_BLOCK_NAME']))
{
  $arParams['MESS_REGION_BLOCK_NAME'] = Loc::getMessage('REGION_BLOCK_NAME_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_PAYMENT_BLOCK_NAME']))
{
  $arParams['MESS_PAYMENT_BLOCK_NAME'] = Loc::getMessage('PAYMENT_BLOCK_NAME_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_DELIVERY_BLOCK_NAME']))
{
  $arParams['MESS_DELIVERY_BLOCK_NAME'] = Loc::getMessage('DELIVERY_BLOCK_NAME_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_BUYER_BLOCK_NAME']))
{
  $arParams['MESS_BUYER_BLOCK_NAME'] = Loc::getMessage('BUYER_BLOCK_NAME_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_BACK']))
{
  $arParams['MESS_BACK'] = Loc::getMessage('BACK_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_FURTHER']))
{
  $arParams['MESS_FURTHER'] = Loc::getMessage('FURTHER_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_EDIT']))
{
  $arParams['MESS_EDIT'] = Loc::getMessage('EDIT_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_ORDER']))
{
  $arParams['MESS_ORDER'] = $arParams['~MESS_ORDER'] = Loc::getMessage('ORDER_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_PRICE']))
{
  $arParams['MESS_PRICE'] = Loc::getMessage('PRICE_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_PERIOD']))
{
  $arParams['MESS_PERIOD'] = Loc::getMessage('PERIOD_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_NAV_BACK']))
{
  $arParams['MESS_NAV_BACK'] = Loc::getMessage('NAV_BACK_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_NAV_FORWARD']))
{
  $arParams['MESS_NAV_FORWARD'] = Loc::getMessage('NAV_FORWARD_DEFAULT');
}

$useDefaultMessages = !isset($arParams['USE_CUSTOM_ADDITIONAL_MESSAGES']) || $arParams['USE_CUSTOM_ADDITIONAL_MESSAGES'] != 'Y';

if ($useDefaultMessages || !isset($arParams['MESS_PRICE_FREE']))
{
  $arParams['MESS_PRICE_FREE'] = Loc::getMessage('PRICE_FREE_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_ECONOMY']))
{
  $arParams['MESS_ECONOMY'] = Loc::getMessage('ECONOMY_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_REGISTRATION_REFERENCE']))
{
  $arParams['MESS_REGISTRATION_REFERENCE'] = Loc::getMessage('REGISTRATION_REFERENCE_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_AUTH_REFERENCE_1']))
{
  $arParams['MESS_AUTH_REFERENCE_1'] = Loc::getMessage('AUTH_REFERENCE_1_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_AUTH_REFERENCE_2']))
{
  $arParams['MESS_AUTH_REFERENCE_2'] = Loc::getMessage('AUTH_REFERENCE_2_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_AUTH_REFERENCE_3']))
{
  $arParams['MESS_AUTH_REFERENCE_3'] = Loc::getMessage('AUTH_REFERENCE_3_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_ADDITIONAL_PROPS']))
{
  $arParams['MESS_ADDITIONAL_PROPS'] = Loc::getMessage('ADDITIONAL_PROPS_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_USE_COUPON']))
{
  $arParams['MESS_USE_COUPON'] = Loc::getMessage('USE_COUPON_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_COUPON']))
{
  $arParams['MESS_COUPON'] = Loc::getMessage('COUPON_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_PERSON_TYPE']))
{
  $arParams['MESS_PERSON_TYPE'] = Loc::getMessage('PERSON_TYPE_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_SELECT_PROFILE']))
{
  $arParams['MESS_SELECT_PROFILE'] = Loc::getMessage('SELECT_PROFILE_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_REGION_REFERENCE']))
{
  $arParams['MESS_REGION_REFERENCE'] = Loc::getMessage('REGION_REFERENCE_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_PICKUP_LIST']))
{
  $arParams['MESS_PICKUP_LIST'] = Loc::getMessage('PICKUP_LIST_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_NEAREST_PICKUP_LIST']))
{
  $arParams['MESS_NEAREST_PICKUP_LIST'] = Loc::getMessage('NEAREST_PICKUP_LIST_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_SELECT_PICKUP']))
{
  $arParams['MESS_SELECT_PICKUP'] = Loc::getMessage('SELECT_PICKUP_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_INNER_PS_BALANCE']))
{
  $arParams['MESS_INNER_PS_BALANCE'] = Loc::getMessage('INNER_PS_BALANCE_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_ORDER_DESC']))
{
  $arParams['MESS_ORDER_DESC'] = Loc::getMessage('ORDER_DESC_DEFAULT');
}

$useDefaultMessages = !isset($arParams['USE_CUSTOM_ERROR_MESSAGES']) || $arParams['USE_CUSTOM_ERROR_MESSAGES'] != 'Y';

if ($useDefaultMessages || !isset($arParams['MESS_PRELOAD_ORDER_TITLE']))
{
  $arParams['MESS_PRELOAD_ORDER_TITLE'] = Loc::getMessage('PRELOAD_ORDER_TITLE_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_SUCCESS_PRELOAD_TEXT']))
{
  $arParams['MESS_SUCCESS_PRELOAD_TEXT'] = Loc::getMessage('SUCCESS_PRELOAD_TEXT_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_FAIL_PRELOAD_TEXT']))
{
  $arParams['MESS_FAIL_PRELOAD_TEXT'] = Loc::getMessage('FAIL_PRELOAD_TEXT_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_DELIVERY_CALC_ERROR_TITLE']))
{
  $arParams['MESS_DELIVERY_CALC_ERROR_TITLE'] = Loc::getMessage('DELIVERY_CALC_ERROR_TITLE_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_DELIVERY_CALC_ERROR_TEXT']))
{
  $arParams['MESS_DELIVERY_CALC_ERROR_TEXT'] = Loc::getMessage('DELIVERY_CALC_ERROR_TEXT_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_PAY_SYSTEM_PAYABLE_ERROR']))
{
  $arParams['MESS_PAY_SYSTEM_PAYABLE_ERROR'] = Loc::getMessage('PAY_SYSTEM_PAYABLE_ERROR_DEFAULT');
}

$scheme = $request->isHttps() ? 'https' : 'http';

switch (LANGUAGE_ID)
{
  case 'ru':
    $locale = 'ru-RU'; break;
  case 'ua':
    $locale = 'ru-UA'; break;
  case 'tk':
    $locale = 'tr-TR'; break;
  default:
    $locale = 'en-US'; break;
}

$this->addExternalCss('/bitrix/css/main/bootstrap.css');
$APPLICATION->SetAdditionalCSS('/bitrix/css/main/themes/'.$arParams['TEMPLATE_THEME'].'/style.css', true);
$APPLICATION->SetAdditionalCSS($templateFolder.'/style.css', true);
$this->addExternalJs($templateFolder.'/order_ajax.js');
\Bitrix\Sale\PropertyValueCollection::initJs();
$this->addExternalJs($templateFolder.'/script.js');
?>
<NOSCRIPT>
    <div style="color:red"><?=Loc::getMessage('SOA_NO_JS')?></div>
</NOSCRIPT>
<?

if (strlen($request->get('ORDER_ID')) > 0)
{
  include(Main\Application::getDocumentRoot().$templateFolder.'/confirm.php');
}
elseif ($arParams['DISABLE_BASKET_REDIRECT'] === 'Y' && $arResult['SHOW_EMPTY_BASKET'])
{
  include(Main\Application::getDocumentRoot().$templateFolder.'/empty.php');
}
else
{
  $hideDelivery = empty($arResult['DELIVERY']);
  ?>
<form action="<?=POST_FORM_ACTION_URI?>" method="POST" name="ORDER_FORM" id="bx-soa-order-form"
    enctype="multipart/form-data">
    <?
    echo bitrix_sessid_post();

    if (strlen($arResult['PREPAY_ADIT_FIELDS']) > 0)
    {
      echo $arResult['PREPAY_ADIT_FIELDS'];
    }
    ?>
    <input type="hidden" name="<?=$arParams['ACTION_VARIABLE']?>" value="saveOrderAjax">
    <input type="hidden" name="location_type" value="code">
    <input type="hidden" name="BUYER_STORE" id="BUYER_STORE" value="<?=$arResult['BUYER_STORE']?>">
    <div id="bx-soa-order" class="row bx-<?=$arParams['TEMPLATE_THEME']?>" style="opacity: 0">
        <!--  MAIN BLOCK  -->
        <div class="col-sm-9 bx-soa">
            <div id="bx-soa-main-notifications">
                <div class="alert alert-danger" style="display:none"></div>
                <div data-type="informer" style="display:none"></div>
            </div>
            <!--  AUTH BLOCK  -->
            <div id="bx-soa-auth" class="bx-soa-section bx-soa-auth" style="display:none">
                <div class="bx-soa-section-title-container">
                    <h2 class="bx-soa-section-title col-sm-9">
                        <span class="bx-soa-section-title-count"></span><?=$arParams['MESS_AUTH_BLOCK_NAME']?>
                    </h2>
                </div>
                <div class="bx-soa-section-content container-fluid"></div>
            </div>

            <!--  DUPLICATE MOBILE ORDER SAVE BLOCK -->
            <div id="bx-soa-total-mobile" style="margin-bottom: 6px;min-height: 400px;" class="visible-xs"></div>

            <? if ($arParams['BASKET_POSITION'] === 'before'): ?>
            <!--  BASKET ITEMS BLOCK222  -->
            <div id="bx-soa-basket" data-visited="false" class="bx-soa-section bx-active">
                <div class="bx-soa-section-title-container">
                    <h2 class="bx-soa-section-title col-sm-9">
                        <span class="bx-soa-section-title-count"></span><?=$arParams['MESS_BASKET_BLOCK_NAME']?>
                    </h2>
                    <div class="col-xs-12 col-sm-3 text-right"><a href="javascript:void(0)"
                            class="bx-soa-editstep"><?=$arParams['MESS_EDIT']?></a></div>
                </div>
                <div class="bx-soa-section-content container-fluid"></div>
            </div>
            <? endif ?>

            <!--  REGION BLOCK  -->
            <div id="bx-soa-region" data-visited="false" class="bx-soa-section bx-active">
                <div class="bx-soa-section-title-container">
                    <h2 class="bx-soa-section-title col-sm-9">
                        <span class="bx-soa-section-title-count"></span><?=$arParams['MESS_REGION_BLOCK_NAME']?>
                    </h2>
                    <div class="col-xs-12 col-sm-3 text-right"><a href=""
                            class="bx-soa-editstep"><?=$arParams['MESS_EDIT']?></a></div>
                </div>
                <div class="bx-soa-section-content container-fluid"></div>
            </div>

            <?if ($arParams['DELIVERY_TO_PAYSYSTEM'] === 'p2d'): ?>
            <!--  PAY SYSTEMS BLOCK -->
            <div id="bx-soa-paysystem" data-visited="false" class="bx-soa-section bx-active">
                <div class="bx-soa-section-title-container">
                    <h2 class="bx-soa-section-title col-sm-9">
                        <span class="bx-soa-section-title-count"></span><?=$arParams['MESS_PAYMENT_BLOCK_NAME']?>
                    </h2>
                    <div class="col-xs-12 col-sm-3 text-right"><a href=""
                            class="bx-soa-editstep"><?=$arParams['MESS_EDIT']?></a></div>
                </div>
                <div class="bx-soa-section-content container-fluid"></div>
            </div>
            <!--  PICKUP BLOCK  -->
            <div id="bx-soa-pickup" data-visited="false" class="bx-soa-section" style="display:none">
                <div class="bx-soa-section-title-container">
                    <h2 class="bx-soa-section-title col-sm-9">
                        <span class="bx-soa-section-title-count"></span>
                    </h2>
                    <div class="col-xs-12 col-sm-3 text-right"><a href=""
                            class="bx-soa-editstep"><?=$arParams['MESS_EDIT']?></a></div>
                </div>
                <div class="bx-soa-section-content container-fluid"></div>
            </div>
            <!--  DELIVERY BLOCK  -->
            <div id="bx-soa-delivery" data-visited="false" class="bx-soa-section bx-active"
                <?=($hideDelivery ? 'style="display:none"' : '')?>>
                <div class="bx-soa-section-title-container">
                    <h2 class="bx-soa-section-title col-sm-9">
                        <span class="bx-soa-section-title-count"></span><?=$arParams['MESS_DELIVERY_BLOCK_NAME']?>
                    </h2>
                    <div class="col-xs-12 col-sm-3 text-right"><a href=""
                            class="bx-soa-editstep"><?=$arParams['MESS_EDIT']?></a></div>
                </div>
                <div class="bx-soa-section-content container-fluid"></div>
            </div>
            <!--  BUYER PROPS BLOCK -->
            <div id="bx-soa-properties" data-visited="false" class="bx-soa-section bx-active">
                <div class="bx-soa-section-title-container">
                    <h2 class="bx-soa-section-title col-sm-9">
                        <span class="bx-soa-section-title-count"></span><?=$arParams['MESS_BUYER_BLOCK_NAME']?>
                    </h2>
                    <div class="col-xs-12 col-sm-3 text-right"><a href=""
                            class="bx-soa-editstep"><?=$arParams['MESS_EDIT']?></a></div>
                </div>
                <div class="bx-soa-section-content container-fluid"></div>
            </div>

            <? else: ?>

            <!-- DELIVERY BLOCK  -->
            <div id="bx-soa-delivery" data-visited="false" class="bx-soa-section bx-active"
                <?=($hideDelivery ? 'style="display:none"' : '')?>>
                <div class="bx-soa-section-title-container">
                    <h2 class="bx-soa-section-title col-sm-9">
                        <span class="bx-soa-section-title-count"></span><?=$arParams['MESS_DELIVERY_BLOCK_NAME']?>
                    </h2>
                    <div class="col-xs-12 col-sm-3 text-right"><a href=""
                            class="bx-soa-editstep"><?=$arParams['MESS_EDIT']?></a></div>
                </div>
                <div class="bx-soa-section-content container-fluid"></div>
            </div>
            <!--  PICKUP BLOCK  -->
            <div id="bx-soa-pickup" data-visited="false" class="bx-soa-section" style="display:none">
                <div class="bx-soa-section-title-container">
                    <h2 class="bx-soa-section-title col-sm-9">
                        <span class="bx-soa-section-title-count"></span>
                    </h2>
                    <div class="col-xs-12 col-sm-3 text-right"><a href=""
                            class="bx-soa-editstep"><?=$arParams['MESS_EDIT']?></a></div>
                </div>
                <div class="bx-soa-section-content container-fluid"></div>
            </div>
            <!--  BUYER PROPS BLOCK -->
            <div id="bx-soa-properties" data-visited="false" class="bx-soa-section bx-active">
                <div class="bx-soa-section-title-container">
                    <h2 class="bx-soa-section-title col-sm-9">
                        <span class="bx-soa-section-title-count"></span><?=$arParams['MESS_BUYER_BLOCK_NAME']?>
                    </h2>
                    <div class="col-xs-12 col-sm-3 text-right"><a href=""
                            class="bx-soa-editstep"><?=$arParams['MESS_EDIT']?></a></div>
                </div>
                <div class="bx-soa-section-content container-fluid"></div>
            </div>
            <!--  PAY SYSTEMS BLOCK -->
            <div id="bx-soa-paysystem" data-visited="false" class="bx-soa-section bx-active">
                <div class="bx-soa-section-title-container">
                    <h2 class="bx-soa-section-title col-sm-9">
                        <span class="bx-soa-section-title-count"></span><?=$arParams['MESS_PAYMENT_BLOCK_NAME']?>
                    </h2>
                    <div class="col-xs-12 col-sm-3 text-right"><a href=""
                            class="bx-soa-editstep"><?=$arParams['MESS_EDIT']?></a></div>
                </div>
                <div class="bx-soa-section-content container-fluid"></div>
            </div>

            <? endif ?>

            <? if ($arParams['BASKET_POSITION'] === 'after'): ?>
            <!--  BASKET ITEMS BLOCK  -->
            <div id="bx-soa-basket" data-visited="false" class="bx-soa-section bx-active">
                <div class="bx-soa-section-title-container">
                    <h2 class="bx-soa-section-title col-sm-9">
                        <span class="bx-soa-section-title-count"></span><?=$arParams['MESS_BASKET_BLOCK_NAME']?>
                    </h2>
                    <div class="col-xs-12 col-sm-3 text-right"><a href="javascript:void(0)"
                            class="bx-soa-editstep"><?=$arParams['MESS_EDIT']?></a></div>
                </div>
                <div class="bx-soa-section-content container-fluid"></div>
            </div>
            <? endif ?>

            <?//Костыльная вставка для переноса блока "комментарий"?>
            <div id="outsideComment" class="outsideComment">
                <div class="outsideComment__container">
                    <h2 class="outsideComment__title col-sm-9"><?=$arParams['MESS_ORDER_DESC']?></h2>
                </div>
                <div class="outsideComment__content container-fluid"></div>
            </div>

            <!--  ORDER SAVE BLOCK  -->
            <div id="bx-soa-orderSave">
                <div class="checkbox">
                    <?
                /*if ($arParams['USER_CONSENT'] === 'Y')
                {
                $APPLICATION->IncludeComponent(
                    'bitrix:main.userconsent.request',
                    '',
                    array(
                    'ID' => $arParams['USER_CONSENT_ID'],
                    'IS_CHECKED' => $arParams['USER_CONSENT_IS_CHECKED'],
                    'IS_LOADED' => $arParams['USER_CONSENT_IS_LOADED'],
                    'AUTO_SAVE' => 'N',
                    'SUBMIT_EVENT_NAME' => 'bx-soa-order-save',
                    'REPLACE' => array(
                        'button_caption' => isset($arParams['~MESS_ORDER']) ? $arParams['~MESS_ORDER'] : $arParams['MESS_ORDER'],
                        'fields' => $arResult['USER_CONSENT_PROPERTY_DATA']
                    )
                    )
                );
                }*/
                ?>
                </div>
                <a href="javascript:void(0)" style="margin: 10px 0; padding: 18px;"
                    class="pull-right btn btn-default btn-lg save-mob-zakaz"
                    data-save-button="true">
                    <?=$arParams['MESS_ORDER']?>
                </a>
            </div>

            <div style="display: none;">
                <div id='bx-soa-basket-hidden' class="bx-soa-section"></div>
                <div id='bx-soa-region-hidden' class="bx-soa-section"></div>
                <div id='bx-soa-paysystem-hidden' class="bx-soa-section"></div>
                <div id='bx-soa-delivery-hidden' class="bx-soa-section"></div>
                <div id='bx-soa-pickup-hidden' class="bx-soa-section"></div>
                <div id="bx-soa-properties-hidden" class="bx-soa-section"></div>
                <div id="bx-soa-auth-hidden" class="bx-soa-section">
                    <div class="bx-soa-section-content container-fluid reg"></div>
                </div>
            </div>
        </div>

        <!--  SIDEBAR BLOCK -->
        <div id="bx-soa-total" class="col-sm-3 bx-soa-sidebar">
            <div class="bx-soa-cart-total-ghost"></div>
            <div class="bx-soa-cart-total"></div>
        </div>
    </div>
</form>

<div id="bx-soa-saved-files" style="display:none"></div>
<div id="bx-soa-soc-auth-services" style="display:none">
    <?
    $arServices = false;
    $arResult['ALLOW_SOCSERV_AUTHORIZATION'] = Main\Config\Option::get('main', 'allow_socserv_authorization', 'Y') != 'N' ? 'Y' : 'N';
    $arResult['FOR_INTRANET'] = false;

    if (Main\ModuleManager::isModuleInstalled('intranet') || Main\ModuleManager::isModuleInstalled('rest'))
      $arResult['FOR_INTRANET'] = true;

    if (Main\Loader::includeModule('socialservices') && $arResult['ALLOW_SOCSERV_AUTHORIZATION'] === 'Y')
    {
      $oAuthManager = new CSocServAuthManager();
      $arServices = $oAuthManager->GetActiveAuthServices(array(
        'BACKURL' => $this->arParams['~CURRENT_PAGE'],
        'FOR_INTRANET' => $arResult['FOR_INTRANET'],
      ));

      if (!empty($arServices))
      {
        $APPLICATION->IncludeComponent(
          'bitrix:socserv.auth.form',
          'flat',
          array(
            'AUTH_SERVICES' => $arServices,
            'AUTH_URL' => $arParams['~CURRENT_PAGE'],
            'POST' => $arResult['POST'],
          ),
          $component,
          array('HIDE_ICONS' => 'Y')
        );
      }
    }
    ?>
</div>

<div style="display: none">
    <?/*
    // we need to have all styles for sale.location.selector.steps, but RestartBuffer() cuts off document head with styles in it
    $APPLICATION->IncludeComponent(
	"bitrix:sale.location.selector.steps", 
	".default", 
	array(
		"ID" => "120470",
		"COMPONENT_TEMPLATE" => ".default",
		"CODE" => "0000422109",
		"INPUT_NAME" => "LOCATION",
		"PROVIDE_LINK_BY" => "id",
		"PRESELECT_TREE_TRUNK" => "N",
		"PRECACHE_LAST_LEVEL" => "N",
		"FILTER_BY_SITE" => "Y",
		"SHOW_DEFAULT_LOCATIONS" => "Y",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"JS_CONTROL_GLOBAL_ID" => "",
		"JS_CALLBACK" => "",
		"SUPPRESS_ERRORS" => "N",
		"DISABLE_KEYBOARD_INPUT" => "N",
		"INITIALIZE_BY_GLOBAL_EVENT" => ""
	),
	false
);
    $APPLICATION->IncludeComponent(
	"bitrix:sale.location.selector.search", 
	".default", 
	array(
		"ID" => "120470",
		"COMPONENT_TEMPLATE" => ".default",
		"CODE" => "0000422109",
		"INPUT_NAME" => "LOCATION",
		"PROVIDE_LINK_BY" => "id",
		"FILTER_BY_SITE" => "Y",
		"SHOW_DEFAULT_LOCATIONS" => "Y",
		"FILTER_SITE_ID" => "current",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"JS_CONTROL_GLOBAL_ID" => "",
		"JS_CALLBACK" => "",
		"SUPPRESS_ERRORS" => "N",
		"INITIALIZE_BY_GLOBAL_EVENT" => ""
	),
	false
);
    */?>
</div>
<?
  $signer = new Main\Security\Sign\Signer;
  $signedParams = $signer->sign(base64_encode(serialize($arParams)), 'sale.order.ajax');
  $messages = Loc::loadLanguageFile(__FILE__);
  ?>
<script>
BX.message(<?=CUtil::PhpToJSObject($messages)?>);
BX.Sale.OrderAjaxComponent.init({
    result: <?=CUtil::PhpToJSObject($arResult['JS_DATA'])?>,
    locations: <?=CUtil::PhpToJSObject($arResult['LOCATIONS'])?>,
    params: <?=CUtil::PhpToJSObject($arParams)?>,
    signedParamsString: '<?=CUtil::JSEscape($signedParams)?>',
    siteID: '<?=CUtil::JSEscape($component->getSiteId())?>',
    ajaxUrl: '<?=CUtil::JSEscape($component->getPath().'/ajax.php')?>',
    templateFolder: '<?=CUtil::JSEscape($templateFolder)?>',
    propertyValidation: true,
    showWarnings: true,
    pickUpMap: {
        defaultMapPosition: {
            lat: 55.76,
            lon: 37.64,
            zoom: 7
        },
        secureGeoLocation: false,
        geoLocationMaxTime: 5000,
        minToShowNearestBlock: 3,
        nearestPickUpsToShow: 3
    },
    propertyMap: {
        defaultMapPosition: {
            lat: 55.76,
            lon: 37.64,
            zoom: 7
        }
    },
    orderBlockId: 'bx-soa-order',
    authBlockId: 'bx-soa-auth',
    basketBlockId: 'bx-soa-basket',
    regionBlockId: 'bx-soa-region',
    paySystemBlockId: 'bx-soa-paysystem',
    deliveryBlockId: 'bx-soa-delivery',
    pickUpBlockId: 'bx-soa-pickup',
    propsBlockId: 'bx-soa-properties',
    totalBlockId: 'bx-soa-total'
});
</script>
<?
// spike: for children of cities we place this prompt
$city = \Bitrix\ Sale\ Location\ TypeTable::getList(array('filter' => array('=CODE' => 'CITY'), 'select' => array(
    'ID'))) -> fetch(); ?>
<script>
BX.saleOrderAjax.init(<?=CUtil::PhpToJSObject(array(
      'source' => $component->getPath().'/get.php',
      'cityTypeId' => intval($city['ID']),
      'messages' => array(
        'otherLocation' => '--- '.Loc::getMessage('SOA_OTHER_LOCATION'),
        'moreInfoLocation' => '--- '.Loc::getMessage('SOA_NOT_SELECTED_ALT'), // spike: for children of cities we place this prompt
        'notFoundPrompt' => '<div class="-bx-popup-special-prompt">'.Loc::getMessage('SOA_LOCATION_NOT_FOUND').'.<br />'.Loc::getMessage('SOA_LOCATION_NOT_FOUND_PROMPT', array(
            '#ANCHOR#' => '<a href="javascript:void(0)" class="-bx-popup-set-mode-add-loc">',
            '#ANCHOR_END#' => '</a>'
          )).'</div>'
      )
    ))?>);
</script>
<?
  if ($arParams['SHOW_PICKUP_MAP'] === 'Y' || $arParams['SHOW_MAP_IN_PROPS'] === 'Y')
  {
    if ($arParams['PICKUP_MAP_TYPE'] === 'yandex')
    {
      $this->addExternalJs($templateFolder.'/scripts/yandex_maps.js');
      ?>
<?/*<script src="<?=$scheme?>://api-maps.yandex.ru/2.1.50/?load=package.full&lang=<?=$locale?>"></script>*/?>
<script>
(function bx_ymaps_waiter() {
    if (typeof ymaps !== 'undefined' && BX.Sale && BX.Sale.OrderAjaxComponent)
        ymaps.ready(BX.proxy(BX.Sale.OrderAjaxComponent.initMaps, BX.Sale.OrderAjaxComponent));
    else
        setTimeout(bx_ymaps_waiter, 100);
})();
</script>
<?
    }

    if ($arParams['PICKUP_MAP_TYPE'] === 'google')
    {
      $this->addExternalJs($templateFolder.'/scripts/google_maps.js');
      $apiKey = htmlspecialcharsbx(Main\Config\Option::get('fileman', 'google_map_api_key', ''));
      ?>
<script async defer src="<?=$scheme?>://maps.googleapis.com/maps/api/js?key=<?=$apiKey?>&callback=bx_gmaps_waiter">
</script>
<script>
function bx_gmaps_waiter() {
    if (BX.Sale && BX.Sale.OrderAjaxComponent)
        BX.Sale.OrderAjaxComponent.initMaps();
    else
        setTimeout(bx_gmaps_waiter, 100);
}
</script>
<?
    }
  }

  if ($arParams['USE_YM_GOALS'] === 'Y')
  {
    ?>
<script>
(function bx_counter_waiter(i) {
    i = i || 0;
    if (i > 50)
        return;

    if (typeof window['yaCounter<?=$arParams['YM_GOALS_COUNTER']?>'] !== 'undefined')
        BX.Sale.OrderAjaxComponent.reachGoal('initialization');
    else
        setTimeout(function() {
            bx_counter_waiter(++i)
        }, 100);
})();
</script>
<?
  }
}
?>

<script>
$(document).on('keyup', 'input[name="ORDER_PROP_2"]', function() {
    var value_mail = $(this).val();
    $('input[name="ORDER_PROP_35"]').val(value_mail);
    $('input[name="ORDER_PROP_35"]').attr('value', value_mail);
});
$(document).on('mousedown', '#bx-soa-paysystem .pull-right', function() {
    $('div#bx-soa-orderSave').show();
});
$(document).on('touchstart', '#bx-soa-paysystem .pull-right', function() {
    $('a.save-mob-zakaz').attr('style', 'display:block !imporatant;width:100%');
});
</script>
<style>
.ph--col-xxs-12.ph--col-xs-12.ph--col-sm-12.ph--col-md-9.ph--col-xl-9.ph--col-lg-9.ph--gutter {
    margin-top: 50px;
}

@media only screen and (max-width:1000px) and (min-width:200px) {
    div#bx-soa-orderSave {
        height: 50px;
    }
}

.ph--none-xxs.ph--none-xs.ph--none-sm.ph--col-md-3.ph--col-xl-3.ph--col-lg-3 {
    margin-top: 50px;
}
</style>
<script>
//Данный код будет работать не только внутри sale.order.ajax, но и во внешних скриптах, поскольку мы обращается к его функциям через пространство имен BX.Sale.OrderAjaxComponent
//'0000386590' - Краснодар, Краснодарский край, Россия;
//'0000422109' - Тимашевск, Тимашевский район, Краснодарский край, Россия;
//'0000418893' - Славянск-на-Кубани, Славянский район, Краснодарский край, Россия;
//'0000400363' - Белореченск, Белореченский район, Краснодарский край, Россия;

/*$(function(){
  if ('false' === sessionStorage.getItem('disallowHandler') || null === sessionStorage.getItem('disallowHandler')) {
    var code = sessionStorage.getItem('restrictedLocationSelection');//Код локации.
    console.log('code: ', code);
    console.log('is null: ', code === null);
    console.log('is not null: ', code !== null);
    console.log('typeof code', typeof code);
    if (code !== null && BX.Sale && BX.Sale.OrderAjaxComponent) {
      $('.dropdown-field').val(code);//Обновляем код в скрытом инпуте
      $('.bx-ui-sls-fake').val(code);

      BX.Sale.OrderAjaxComponent.params.restrictedCitySelection = code; //Записываем в параметры компонента необходимый нам город
      BX.Sale.OrderAjaxComponent.sendRequest();//Обновляем форму
    }
  }
});*/
</script>
<?# блокируем кнопку "Далее", если не заполнено какое-нибудь обязательное поле?>
<script>
$(document).ready(function() {
    var reached_goals = [];
   /* $.goals = function() {
        $('.pull-right.btn.btn-default').each(function(index, item) {
          console.log('item: ', item);
          console.log('item[0]: ', item[0]);
            $(item)[0].addEventListener("click", function() {
                let id = $(item).closest('.bx-soa-section').attr('id');
                if (reached_goals.indexOf(id) == -1) {
                    reached_goals.push(id);
                    
                    switch (id) {
                        case 'bx-soa-basket-hidden':
                            break;
                        case 'bx-soa-region-hidden':
                            ym(5901415, 'reachGoal', 'region_complete')
                            reached_goals.push('region_complete');
                            break;
                        case 'bx-soa-delivery-hidden':
                            ym(5901415, 'reachGoal', 'delivery_complete');
                            reached_goals.push('delivery_complete');
                            break;
                        case 'bx-soa-properties-hidden':
                            ym(5901415, 'reachGoal', 'buyer_complete');
                            reached_goals.push('buyer_complete');
                            break;
                        case 'bx-soa-pickup-hidden':
                            break;
                        case 'bx-soa-paysystem-hidden':
                        default:
                            ym(5901415, 'reachGoal', 'payment_complete');
                            reached_goals.push('payment_complete');
                            ym(5901415, 'reachGoal', 'order_complete');
                            reached_goals.push('order_complete');
                            break;
                    }
                    //console.log('index', index + next_goals[index]);
                }

            }, {
                once: true,
                passive: true
            });

        });


    };
    $.goals();*/
    var neededStep = $('#bx-soa-properties');
    var neededStep2 = $('#bx-soa-region');
    var requiredArray = $('.bx-authform-starrequired', neededStep).closest('.form-group').find('input');
    var requiredArray2 = $('.bx-authform-starrequired', neededStep2).closest('.form-group').find('input');

    function checkFillingRequireParamsByProperties() {
        let neededStep = $('#bx-soa-properties');
        let requiredArray = $('.bx-authform-starrequired', neededStep).closest('.form-group').find('input');
        let check = true;
        if ($("#bx-soa-properties .bx-soa-section").hasClass("bx-step-error") || $(
                "#bx-soa-properties .bx-soa-customer-field").hasClass("has-error")) {
            check = false;
        }

        if (!$(neededStep).hasClass("bx-step-completed")) {

            for (let i = 0; i < requiredArray.length; i++) {
                if (requiredArray[i].value == '') {
                    check = false;
                    break;
                }
            }

            let nextSteps = $(neededStep).nextAll('.bx-soa-section').find(
                '.bx-soa-section-title-container, .bx-soa-section-title-container .bx-soa-editstep');

            
            /*if (check) {
                $('#bx-soa-properties .pull-right.btn').removeClass('active');
                $(nextSteps).removeClass('disabled');
            } else {
                $('#bx-soa-properties .pull-right.btn').addClass('active');
                $(nextSteps).addClass('disabled');
            }*/
        }
    }

    function checkFillingRequireParamsByRegion() {
        let neededStep = $('#bx-soa-region');
        let requiredArray = $('.bx-authform-starrequired', neededStep).closest('.form-group').find('input');
        let check = true;
        if ($("#bx-soa-region .bx-soa-section").hasClass("bx-step-error")) {
            check = false;
        }
        if (!$(neededStep).hasClass("bx-step-completed")) {
            for (let i = 0; i < requiredArray.length; i++) {
                if (requiredArray[i].value == '') {
                    check = false;
                    break;
                }
            }
            let nextSteps = $(neededStep).nextAll('.bx-soa-section').find(
                '.bx-soa-section-title-container, .bx-soa-section-title-container .bx-soa-editstep');

            if (check) {
                console.log('removeClass active, disabled');
                $('#bx-soa-region .pull-right.btn').removeClass('active');
                $(nextSteps).removeClass('disabled');
            } else {
                console.log('addClass active, disabled');
                $('#bx-soa-region .pull-right.btn').addClass('active');
                $(nextSteps).addClass('disabled');
            }
        }
    }
    BX.addCustomEvent('onAjaxSuccess', function() {
        console.log('onAjaxSuccess');
        // $.goals();
        checkFillingRequireParamsByProperties();
        checkFillingRequireParamsByRegion();
    });

    //if($(neededStep).hasClass('.bx-selected')){

    checkFillingRequireParamsByProperties();
    // }elseif($(neededStep2).hasClass('.bx-selected')){
    checkFillingRequireParamsByRegion();
    //  }
    $('#bx-soa-delivery input').on('change', checkFillingRequireParamsByProperties);
    $(document).on('change',
        requiredArray, checkFillingRequireParamsByProperties);
    $(document).on('change', requiredArray2,
        checkFillingRequireParamsByRegion);
    //$(document).on('click', '.pull-right.btn', checkFillingRequireParamsByProperties);


    $('.bx-soa-section-title-container').bind('click', function() {
        event.stopImmediatePropagation();
    });
});
</script>