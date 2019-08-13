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
$countries_list = new countries_list();

// Run the page
$countries_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$countries_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$countries->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fcountrieslist = currentForm = new ew.Form("fcountrieslist", "list");
fcountrieslist.formKeyCountName = '<?php echo $countries_list->FormKeyCountName ?>';

// Form_CustomValidate event
fcountrieslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcountrieslist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fcountrieslistsrch = currentSearchForm = new ew.Form("fcountrieslistsrch");

// Filters
fcountrieslistsrch.filterList = <?php echo $countries_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$countries->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($countries_list->TotalRecs > 0 && $countries_list->ExportOptions->visible()) { ?>
<?php $countries_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($countries_list->ImportOptions->visible()) { ?>
<?php $countries_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($countries_list->SearchOptions->visible()) { ?>
<?php $countries_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($countries_list->FilterOptions->visible()) { ?>
<?php $countries_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$countries_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$countries->isExport() && !$countries->CurrentAction) { ?>
<form name="fcountrieslistsrch" id="fcountrieslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($countries_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fcountrieslistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="countries">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($countries_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->Phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($countries_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->Phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $countries_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($countries_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->Phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($countries_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->Phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($countries_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->Phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($countries_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->Phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $countries_list->showPageHeader(); ?>
<?php
$countries_list->showMessage();
?>
<?php if ($countries_list->TotalRecs > 0 || $countries->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($countries_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> countries">
<form name="fcountrieslist" id="fcountrieslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($countries_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $countries_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="countries">
<div id="gmp_countries" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($countries_list->TotalRecs > 0 || $countries->isGridEdit()) { ?>
<table id="tbl_countrieslist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$countries_list->RowType = ROWTYPE_HEADER;

// Render list options
$countries_list->renderListOptions();

// Render list options (header, left)
$countries_list->ListOptions->render("header", "left");
?>
<?php if ($countries->id->Visible) { // id ?>
	<?php if ($countries->sortUrl($countries->id) == "") { ?>
		<th data-name="id" class="<?php echo $countries->id->headerCellClass() ?>"><div id="elh_countries_id" class="countries_id"><div class="ew-table-header-caption"><?php echo $countries->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $countries->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $countries->SortUrl($countries->id) ?>',1);"><div id="elh_countries_id" class="countries_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $countries->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($countries->id->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($countries->id->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($countries->name->Visible) { // name ?>
	<?php if ($countries->sortUrl($countries->name) == "") { ?>
		<th data-name="name" class="<?php echo $countries->name->headerCellClass() ?>"><div id="elh_countries_name" class="countries_name"><div class="ew-table-header-caption"><?php echo $countries->name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="name" class="<?php echo $countries->name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $countries->SortUrl($countries->name) ?>',1);"><div id="elh_countries_name" class="countries_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $countries->name->caption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($countries->name->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($countries->name->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$countries_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($countries->ExportAll && $countries->isExport()) {
	$countries_list->StopRec = $countries_list->TotalRecs;
} else {

	// Set the last record to display
	if ($countries_list->TotalRecs > $countries_list->StartRec + $countries_list->DisplayRecs - 1)
		$countries_list->StopRec = $countries_list->StartRec + $countries_list->DisplayRecs - 1;
	else
		$countries_list->StopRec = $countries_list->TotalRecs;
}
$countries_list->RecCnt = $countries_list->StartRec - 1;
if ($countries_list->Recordset && !$countries_list->Recordset->EOF) {
	$countries_list->Recordset->moveFirst();
	$selectLimit = $countries_list->UseSelectLimit;
	if (!$selectLimit && $countries_list->StartRec > 1)
		$countries_list->Recordset->move($countries_list->StartRec - 1);
} elseif (!$countries->AllowAddDeleteRow && $countries_list->StopRec == 0) {
	$countries_list->StopRec = $countries->GridAddRowCount;
}

// Initialize aggregate
$countries->RowType = ROWTYPE_AGGREGATEINIT;
$countries->resetAttributes();
$countries_list->renderRow();
while ($countries_list->RecCnt < $countries_list->StopRec) {
	$countries_list->RecCnt++;
	if ($countries_list->RecCnt >= $countries_list->StartRec) {
		$countries_list->RowCnt++;

		// Set up key count
		$countries_list->KeyCount = $countries_list->RowIndex;

		// Init row class and style
		$countries->resetAttributes();
		$countries->CssClass = "";
		if ($countries->isGridAdd()) {
		} else {
			$countries_list->loadRowValues($countries_list->Recordset); // Load row values
		}
		$countries->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$countries->RowAttrs = array_merge($countries->RowAttrs, array('data-rowindex'=>$countries_list->RowCnt, 'id'=>'r' . $countries_list->RowCnt . '_countries', 'data-rowtype'=>$countries->RowType));

		// Render row
		$countries_list->renderRow();

		// Render list options
		$countries_list->renderListOptions();
?>
	<tr<?php echo $countries->rowAttributes() ?>>
<?php

// Render list options (body, left)
$countries_list->ListOptions->render("body", "left", $countries_list->RowCnt);
?>
	<?php if ($countries->id->Visible) { // id ?>
		<td data-name="id"<?php echo $countries->id->cellAttributes() ?>>
<span id="el<?php echo $countries_list->RowCnt ?>_countries_id" class="countries_id">
<span<?php echo $countries->id->viewAttributes() ?>>
<?php echo $countries->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($countries->name->Visible) { // name ?>
		<td data-name="name"<?php echo $countries->name->cellAttributes() ?>>
<span id="el<?php echo $countries_list->RowCnt ?>_countries_name" class="countries_name">
<span<?php echo $countries->name->viewAttributes() ?>>
<?php echo $countries->name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$countries_list->ListOptions->render("body", "right", $countries_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$countries->isGridAdd())
		$countries_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$countries->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($countries_list->Recordset)
	$countries_list->Recordset->Close();
?>
<?php if (!$countries->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$countries->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($countries_list->Pager)) $countries_list->Pager = new PrevNextPager($countries_list->StartRec, $countries_list->DisplayRecs, $countries_list->TotalRecs, $countries_list->AutoHidePager) ?>
<?php if ($countries_list->Pager->RecordCount > 0 && $countries_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($countries_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $countries_list->pageUrl() ?>start=<?php echo $countries_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($countries_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $countries_list->pageUrl() ?>start=<?php echo $countries_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $countries_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($countries_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $countries_list->pageUrl() ?>start=<?php echo $countries_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($countries_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $countries_list->pageUrl() ?>start=<?php echo $countries_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $countries_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($countries_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $countries_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $countries_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $countries_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php
	foreach ($countries_list->OtherOptions as &$option)
		$option->render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($countries_list->TotalRecs == 0 && !$countries->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php
	foreach ($countries_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$countries_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$countries->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$countries_list->terminate();
?>
