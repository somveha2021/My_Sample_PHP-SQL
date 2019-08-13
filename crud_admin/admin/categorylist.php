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
$category_list = new category_list();

// Run the page
$category_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$category_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$category->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fcategorylist = currentForm = new ew.Form("fcategorylist", "list");
fcategorylist.formKeyCountName = '<?php echo $category_list->FormKeyCountName ?>';

// Form_CustomValidate event
fcategorylist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcategorylist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fcategorylistsrch = currentSearchForm = new ew.Form("fcategorylistsrch");

// Filters
fcategorylistsrch.filterList = <?php echo $category_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$category->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($category_list->TotalRecs > 0 && $category_list->ExportOptions->visible()) { ?>
<?php $category_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($category_list->ImportOptions->visible()) { ?>
<?php $category_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($category_list->SearchOptions->visible()) { ?>
<?php $category_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($category_list->FilterOptions->visible()) { ?>
<?php $category_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$category_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$category->isExport() && !$category->CurrentAction) { ?>
<form name="fcategorylistsrch" id="fcategorylistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($category_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fcategorylistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="category">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($category_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->Phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($category_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->Phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $category_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($category_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->Phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($category_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->Phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($category_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->Phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($category_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->Phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $category_list->showPageHeader(); ?>
<?php
$category_list->showMessage();
?>
<?php if ($category_list->TotalRecs > 0 || $category->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($category_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> category">
<form name="fcategorylist" id="fcategorylist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($category_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $category_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="category">
<div id="gmp_category" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($category_list->TotalRecs > 0 || $category->isGridEdit()) { ?>
<table id="tbl_categorylist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$category_list->RowType = ROWTYPE_HEADER;

// Render list options
$category_list->renderListOptions();

// Render list options (header, left)
$category_list->ListOptions->render("header", "left");
?>
<?php if ($category->category_id->Visible) { // category_id ?>
	<?php if ($category->sortUrl($category->category_id) == "") { ?>
		<th data-name="category_id" class="<?php echo $category->category_id->headerCellClass() ?>"><div id="elh_category_category_id" class="category_category_id"><div class="ew-table-header-caption"><?php echo $category->category_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="category_id" class="<?php echo $category->category_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $category->SortUrl($category->category_id) ?>',1);"><div id="elh_category_category_id" class="category_category_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $category->category_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($category->category_id->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($category->category_id->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($category->name->Visible) { // name ?>
	<?php if ($category->sortUrl($category->name) == "") { ?>
		<th data-name="name" class="<?php echo $category->name->headerCellClass() ?>"><div id="elh_category_name" class="category_name"><div class="ew-table-header-caption"><?php echo $category->name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="name" class="<?php echo $category->name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $category->SortUrl($category->name) ?>',1);"><div id="elh_category_name" class="category_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $category->name->caption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($category->name->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($category->name->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($category->icon->Visible) { // icon ?>
	<?php if ($category->sortUrl($category->icon) == "") { ?>
		<th data-name="icon" class="<?php echo $category->icon->headerCellClass() ?>"><div id="elh_category_icon" class="category_icon"><div class="ew-table-header-caption"><?php echo $category->icon->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="icon" class="<?php echo $category->icon->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $category->SortUrl($category->icon) ?>',1);"><div id="elh_category_icon" class="category_icon">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $category->icon->caption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($category->icon->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($category->icon->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($category->status->Visible) { // status ?>
	<?php if ($category->sortUrl($category->status) == "") { ?>
		<th data-name="status" class="<?php echo $category->status->headerCellClass() ?>"><div id="elh_category_status" class="category_status"><div class="ew-table-header-caption"><?php echo $category->status->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="status" class="<?php echo $category->status->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $category->SortUrl($category->status) ?>',1);"><div id="elh_category_status" class="category_status">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $category->status->caption() ?></span><span class="ew-table-header-sort"><?php if ($category->status->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($category->status->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$category_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($category->ExportAll && $category->isExport()) {
	$category_list->StopRec = $category_list->TotalRecs;
} else {

	// Set the last record to display
	if ($category_list->TotalRecs > $category_list->StartRec + $category_list->DisplayRecs - 1)
		$category_list->StopRec = $category_list->StartRec + $category_list->DisplayRecs - 1;
	else
		$category_list->StopRec = $category_list->TotalRecs;
}
$category_list->RecCnt = $category_list->StartRec - 1;
if ($category_list->Recordset && !$category_list->Recordset->EOF) {
	$category_list->Recordset->moveFirst();
	$selectLimit = $category_list->UseSelectLimit;
	if (!$selectLimit && $category_list->StartRec > 1)
		$category_list->Recordset->move($category_list->StartRec - 1);
} elseif (!$category->AllowAddDeleteRow && $category_list->StopRec == 0) {
	$category_list->StopRec = $category->GridAddRowCount;
}

// Initialize aggregate
$category->RowType = ROWTYPE_AGGREGATEINIT;
$category->resetAttributes();
$category_list->renderRow();
while ($category_list->RecCnt < $category_list->StopRec) {
	$category_list->RecCnt++;
	if ($category_list->RecCnt >= $category_list->StartRec) {
		$category_list->RowCnt++;

		// Set up key count
		$category_list->KeyCount = $category_list->RowIndex;

		// Init row class and style
		$category->resetAttributes();
		$category->CssClass = "";
		if ($category->isGridAdd()) {
		} else {
			$category_list->loadRowValues($category_list->Recordset); // Load row values
		}
		$category->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$category->RowAttrs = array_merge($category->RowAttrs, array('data-rowindex'=>$category_list->RowCnt, 'id'=>'r' . $category_list->RowCnt . '_category', 'data-rowtype'=>$category->RowType));

		// Render row
		$category_list->renderRow();

		// Render list options
		$category_list->renderListOptions();
?>
	<tr<?php echo $category->rowAttributes() ?>>
<?php

// Render list options (body, left)
$category_list->ListOptions->render("body", "left", $category_list->RowCnt);
?>
	<?php if ($category->category_id->Visible) { // category_id ?>
		<td data-name="category_id"<?php echo $category->category_id->cellAttributes() ?>>
<span id="el<?php echo $category_list->RowCnt ?>_category_category_id" class="category_category_id">
<span<?php echo $category->category_id->viewAttributes() ?>>
<?php echo $category->category_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($category->name->Visible) { // name ?>
		<td data-name="name"<?php echo $category->name->cellAttributes() ?>>
<span id="el<?php echo $category_list->RowCnt ?>_category_name" class="category_name">
<span<?php echo $category->name->viewAttributes() ?>>
<?php echo $category->name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($category->icon->Visible) { // icon ?>
		<td data-name="icon"<?php echo $category->icon->cellAttributes() ?>>
<span id="el<?php echo $category_list->RowCnt ?>_category_icon" class="category_icon">
<span<?php echo $category->icon->viewAttributes() ?>>
<?php echo $category->icon->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($category->status->Visible) { // status ?>
		<td data-name="status"<?php echo $category->status->cellAttributes() ?>>
<span id="el<?php echo $category_list->RowCnt ?>_category_status" class="category_status">
<span<?php echo $category->status->viewAttributes() ?>>
<?php echo $category->status->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$category_list->ListOptions->render("body", "right", $category_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$category->isGridAdd())
		$category_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$category->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($category_list->Recordset)
	$category_list->Recordset->Close();
?>
<?php if (!$category->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$category->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($category_list->Pager)) $category_list->Pager = new PrevNextPager($category_list->StartRec, $category_list->DisplayRecs, $category_list->TotalRecs, $category_list->AutoHidePager) ?>
<?php if ($category_list->Pager->RecordCount > 0 && $category_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($category_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $category_list->pageUrl() ?>start=<?php echo $category_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($category_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $category_list->pageUrl() ?>start=<?php echo $category_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $category_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($category_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $category_list->pageUrl() ?>start=<?php echo $category_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($category_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $category_list->pageUrl() ?>start=<?php echo $category_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $category_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($category_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $category_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $category_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $category_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php
	foreach ($category_list->OtherOptions as &$option)
		$option->render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($category_list->TotalRecs == 0 && !$category->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php
	foreach ($category_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$category_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$category->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$category_list->terminate();
?>
