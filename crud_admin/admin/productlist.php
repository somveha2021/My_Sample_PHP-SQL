<?php
namespace PHPMaker2019\Crud_Admin;

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	session_start(); // Init session data

// Output buffering
ob_start(); 

// Autoload
include_once "autoload.php";
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$product_list = new product_list();

// Run the page
$product_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$product_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$product->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fproductlist = currentForm = new ew.Form("fproductlist", "list");
fproductlist.formKeyCountName = '<?php echo $product_list->FormKeyCountName ?>';

// Form_CustomValidate event
fproductlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fproductlist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fproductlistsrch = currentSearchForm = new ew.Form("fproductlistsrch");

// Filters
fproductlistsrch.filterList = <?php echo $product_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$product->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($product_list->TotalRecs > 0 && $product_list->ExportOptions->visible()) { ?>
<?php $product_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($product_list->ImportOptions->visible()) { ?>
<?php $product_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($product_list->SearchOptions->visible()) { ?>
<?php $product_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($product_list->FilterOptions->visible()) { ?>
<?php $product_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$product_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$product->isExport() && !$product->CurrentAction) { ?>
<form name="fproductlistsrch" id="fproductlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($product_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fproductlistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="product">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($product_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->Phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($product_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->Phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $product_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($product_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->Phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($product_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->Phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($product_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->Phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($product_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->Phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $product_list->showPageHeader(); ?>
<?php
$product_list->showMessage();
?>
<?php if ($product_list->TotalRecs > 0 || $product->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($product_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> product">
<form name="fproductlist" id="fproductlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($product_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $product_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="product">
<div id="gmp_product" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($product_list->TotalRecs > 0 || $product->isGridEdit()) { ?>
<table id="tbl_productlist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$product_list->RowType = ROWTYPE_HEADER;

// Render list options
$product_list->renderListOptions();

// Render list options (header, left)
$product_list->ListOptions->render("header", "left");
?>
<?php if ($product->product_code->Visible) { // product_code ?>
	<?php if ($product->sortUrl($product->product_code) == "") { ?>
		<th data-name="product_code" class="<?php echo $product->product_code->headerCellClass() ?>"><div id="elh_product_product_code" class="product_product_code"><div class="ew-table-header-caption"><?php echo $product->product_code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="product_code" class="<?php echo $product->product_code->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $product->SortUrl($product->product_code) ?>',1);"><div id="elh_product_product_code" class="product_product_code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $product->product_code->caption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($product->product_code->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($product->product_code->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($product->product_name->Visible) { // product_name ?>
	<?php if ($product->sortUrl($product->product_name) == "") { ?>
		<th data-name="product_name" class="<?php echo $product->product_name->headerCellClass() ?>"><div id="elh_product_product_name" class="product_product_name"><div class="ew-table-header-caption"><?php echo $product->product_name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="product_name" class="<?php echo $product->product_name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $product->SortUrl($product->product_name) ?>',1);"><div id="elh_product_product_name" class="product_product_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $product->product_name->caption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($product->product_name->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($product->product_name->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($product->product_price->Visible) { // product_price ?>
	<?php if ($product->sortUrl($product->product_price) == "") { ?>
		<th data-name="product_price" class="<?php echo $product->product_price->headerCellClass() ?>"><div id="elh_product_product_price" class="product_product_price"><div class="ew-table-header-caption"><?php echo $product->product_price->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="product_price" class="<?php echo $product->product_price->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $product->SortUrl($product->product_price) ?>',1);"><div id="elh_product_product_price" class="product_product_price">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $product->product_price->caption() ?></span><span class="ew-table-header-sort"><?php if ($product->product_price->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($product->product_price->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$product_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($product->ExportAll && $product->isExport()) {
	$product_list->StopRec = $product_list->TotalRecs;
} else {

	// Set the last record to display
	if ($product_list->TotalRecs > $product_list->StartRec + $product_list->DisplayRecs - 1)
		$product_list->StopRec = $product_list->StartRec + $product_list->DisplayRecs - 1;
	else
		$product_list->StopRec = $product_list->TotalRecs;
}
$product_list->RecCnt = $product_list->StartRec - 1;
if ($product_list->Recordset && !$product_list->Recordset->EOF) {
	$product_list->Recordset->moveFirst();
	$selectLimit = $product_list->UseSelectLimit;
	if (!$selectLimit && $product_list->StartRec > 1)
		$product_list->Recordset->move($product_list->StartRec - 1);
} elseif (!$product->AllowAddDeleteRow && $product_list->StopRec == 0) {
	$product_list->StopRec = $product->GridAddRowCount;
}

// Initialize aggregate
$product->RowType = ROWTYPE_AGGREGATEINIT;
$product->resetAttributes();
$product_list->renderRow();
while ($product_list->RecCnt < $product_list->StopRec) {
	$product_list->RecCnt++;
	if ($product_list->RecCnt >= $product_list->StartRec) {
		$product_list->RowCnt++;

		// Set up key count
		$product_list->KeyCount = $product_list->RowIndex;

		// Init row class and style
		$product->resetAttributes();
		$product->CssClass = "";
		if ($product->isGridAdd()) {
		} else {
			$product_list->loadRowValues($product_list->Recordset); // Load row values
		}
		$product->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$product->RowAttrs = array_merge($product->RowAttrs, array('data-rowindex'=>$product_list->RowCnt, 'id'=>'r' . $product_list->RowCnt . '_product', 'data-rowtype'=>$product->RowType));

		// Render row
		$product_list->renderRow();

		// Render list options
		$product_list->renderListOptions();
?>
	<tr<?php echo $product->rowAttributes() ?>>
<?php

// Render list options (body, left)
$product_list->ListOptions->render("body", "left", $product_list->RowCnt);
?>
	<?php if ($product->product_code->Visible) { // product_code ?>
		<td data-name="product_code"<?php echo $product->product_code->cellAttributes() ?>>
<span id="el<?php echo $product_list->RowCnt ?>_product_product_code" class="product_product_code">
<span<?php echo $product->product_code->viewAttributes() ?>>
<?php echo $product->product_code->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($product->product_name->Visible) { // product_name ?>
		<td data-name="product_name"<?php echo $product->product_name->cellAttributes() ?>>
<span id="el<?php echo $product_list->RowCnt ?>_product_product_name" class="product_product_name">
<span<?php echo $product->product_name->viewAttributes() ?>>
<?php echo $product->product_name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($product->product_price->Visible) { // product_price ?>
		<td data-name="product_price"<?php echo $product->product_price->cellAttributes() ?>>
<span id="el<?php echo $product_list->RowCnt ?>_product_product_price" class="product_product_price">
<span<?php echo $product->product_price->viewAttributes() ?>>
<?php echo $product->product_price->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$product_list->ListOptions->render("body", "right", $product_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$product->isGridAdd())
		$product_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$product->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($product_list->Recordset)
	$product_list->Recordset->Close();
?>
<?php if (!$product->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$product->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($product_list->Pager)) $product_list->Pager = new PrevNextPager($product_list->StartRec, $product_list->DisplayRecs, $product_list->TotalRecs, $product_list->AutoHidePager) ?>
<?php if ($product_list->Pager->RecordCount > 0 && $product_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($product_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $product_list->pageUrl() ?>start=<?php echo $product_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($product_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $product_list->pageUrl() ?>start=<?php echo $product_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $product_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($product_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $product_list->pageUrl() ?>start=<?php echo $product_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($product_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $product_list->pageUrl() ?>start=<?php echo $product_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $product_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($product_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $product_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $product_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $product_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php
	foreach ($product_list->OtherOptions as &$option)
		$option->render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($product_list->TotalRecs == 0 && !$product->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php
	foreach ($product_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$product_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$product->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$product_list->terminate();
?>
