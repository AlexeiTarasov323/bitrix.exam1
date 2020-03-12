
<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>

<div class="item-wrap">
    <div class="rew-footer-carousel">
        <? if ($arParams["DISPLAY_TOP_PAGER"]): ?>
            <?= $arResult["NAV_STRING"] ?><br/>
        <? endif; ?>
        <? foreach ($arResult["ITEMS"] as $arItem): ?>
            <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'],
                CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'],
                CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"),
                ["CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')]);
            ?>
            <div class="item">
                <div class="side-block side-opin" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                    <div class="inner-block">
                        <div class="title">
                            <div class="photo-block">
                                <? if ($arItem["DETAIL_PICTURE"]): ?>
                                    <?php		
                                    $arImageFile = CFile::ResizeImageGet(
                                        $arItem["DETAIL_PICTURE"]["ID"],
                                        ['width' => 39, 'height' => 39],
                                        BX_RESIZE_IMAGE_PROPORTIONAL_ALT,
                                        true
                                    );
                                    $sPictureSrc = $arImageFile['src'];                                   
                                    ?>
                                <? else: ?>
                                    <?php                               
                                    $sPictureSrc = SITE_TEMPLATE_PATH . '/img/rew/no_photo_left_block.jpg';
                                    ?>
                                <? endif; ?>
                                <img src="<?= $sPictureSrc ?>" alt="">
                            </div>
                            <div class="name-block">
                                <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>">
                                    <? if ($arParams["DISPLAY_NAME"] != "N" && $arItem["NAME"]): ?>
                                        <?= $arItem["NAME"] ?>
                                    <? endif; ?>
                                </a>
                            </div>
                            <div class="pos-block">      
                                <? if ($arItem["DISPLAY_PROPERTIES"]["POSITION"]["DISPLAY_VALUE"]): ?>
                                    <?= ucfirst($arItem["DISPLAY_PROPERTIES"]["POSITION"]["DISPLAY_VALUE"]); ?>,
                                <? endif ?>
                                <? if ($arItem["DISPLAY_PROPERTIES"]["COMPANY"]["DISPLAY_VALUE"]): ?>
                                    <?= $arItem["DISPLAY_PROPERTIES"]["COMPANY"]["DISPLAY_VALUE"]; ?>
                                <? endif ?>
                            </div>
                        </div>
                        <? if ($arParams["DISPLAY_PREVIEW_TEXT"] != "N" && $arItem["PREVIEW_TEXT"]): ?>
                            <div class="text-block">							
								<? if ($arItem["PREVIEW_TEXT"]): ?>
                                    <?= $arItem["PREVIEW_TEXT"]; ?>
                                <? endif ?>							                   
                            </div>
                        <? endif; ?>
                    </div>
                </div>
            </div>
        <? endforeach; ?>
        <? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
            <br/><?= $arResult["NAV_STRING"] ?>
        <? endif; ?>
    </div>
</div>
      