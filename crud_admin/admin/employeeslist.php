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
$employees_list = new employees_list();

// Run the page
$employees_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$employees_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$employees->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var femployeeslist = currentForm = new ew.Form("femployeeslist", "list");
femployeeslist.formKeyCountName = '<?php echo $employees_list->FormKeyCountName ?>';

// Form_CustomValidate event
femployeeslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
femployeeslist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var femployeeslistsrch = currentSearchForm = new ew.Form("femployeeslistsrch");

// Filters
femployeeslistsrch.filterList = <?php echo $employees_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$employees->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($employees_list->TotalRecs > 0 && $employees_list->ExportOptions->visible()) { ?>
<?php $employees_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($employees_list->ImportOptions->visible()) { ?>
<?php $employees_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($employees_list->SearchOptions->visible()) { ?>
<?php $employees_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($employees_list->FilterOptions->visible()) { ?>
<?php $employees_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$employees_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$employees->isExport() && !$employees->CurrentAction) { ?>
<form name="femployeeslistsrch" id="femployeeslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($employees_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="femployeeslistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="employees">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($employees_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->Phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($employees_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->Phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $employees_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($employees_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->Phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($employees_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->Phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($employees_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->Phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($employees_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->Phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $employees_list->showPageHeader(); ?>
<?php
$employees_list->showMessage();
?>
<?php if ($employees_list->TotalRecs > 0 || $employees->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($employees_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> employees">
<form name="femployeeslist" id="femployeeslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($employees_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $employees_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="employees">
<div id="gmp_employees" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($employees_list->TotalRecs > 0 || $employees->isGridEdit()) { ?>
<table id="tbl_employeeslist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$employees_list->RowType = ROWTYPE_HEADER;

// Render list options
$employees_list->renderListOptions();

// Render list options (header, left)
$employees_list->ListOptions->render("header", "left");
?>
<?php if ($employees->id->Visible) { // id ?>
	<?php if ($employees->sortUrl($employees->id) == "") { ?>
		<th data-name="id" class="<?php echo $employees->id->headerCellClass() ?>"><div id="elh_employees_id" class="employees_id"><div class="ew-table-header-caption"><?php echo $employees->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $employees->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $employees->SortUrl($employees->id) ?>',1);"><div id="elh_employees_id" class="employees_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employees->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($employees->id->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($employees->id->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employees->name->Visible) { // name ?>
	<?php if ($employees->sortUrl($employees->name) == "") { ?>
		<th data-name="name" class="<?php echo $employees->name->headerCellClass() ?>"><div id="elh_employees_name" class="employees_name"><div class="ew-table-header-caption"><?php echo $employees->name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="name" class="<?php echo $employees->name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $employees->SortUrl($employees->name) ?>',1);"><div id="elh_employees_name" class="employees_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employees->name->caption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($employees->name->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($employees->name->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employees->address->Visible) { // address ?>
	<?php if ($employees->sortUrl($employees->address) == "") { ?>
		<th data-name="address" class="<?php echo $employees->address->headerCellClass() ?>"><div id="elh_employees_address" class="employees_address"><div class="ew-table-header-caption"><?php echo $employees->address->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="address" class="<?php echo $employees->address->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $employees->SortUrl($employees->address) ?>',1);"><div id="elh_employees_address" class="employees_address">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employees->address->caption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($employees->address->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($employees->address->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employees->salary->Visible) { // salary ?>
	<?php if ($employees->sortUrl($employees->salary) == "") { ?>
		<th data-name="salary" class="<?php echo $employees->salary->headerCellClass() ?>"><div id="elh_employees_salary" class="employees_salary"><div class="ew-table-header-caption"><?php echo $employees->salary->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="salary" class="<?php echo $employees->salary->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $employees->SortUrl($employees->salary) ?>',1);"><div id="elh_employees_salary" class="employees_salary">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employees->salary->caption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($employees->salary->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($employees->salary->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employees->photo->Visible) { // photo ?>
	<?php if ($employees->sortUrl($employees->photo) == "") { ?>
		<th data-name="photo" class="<?php echo $employees->photo->headerCellClass() ?>"><div id="elh_employees_photo" class="employees_photo"><div class="ew-table-header-caption"><?php echo $employees->photo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="photo" class="<?php echo $employees->photo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $employees->SortUrl($employees->photo) ?>',1);"><div id="elh_employees_photo" class="employees_photo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employees->photo->caption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($employees->photo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($employees->photo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$employees_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($employees->ExportAll && $employees->isExport()) {
	$employees_list->StopRec = $employees_list->TotalRecs;
} else {

	// Set the last record to display
	if ($employees_list->TotalRecs > $employees_list->StartRec + $employees_list->DisplayRecs - 1)
		$employees_list->StopRec = $employees_list->StartRec + $employees_list->DisplayRecs - 1;
	else
		$employees_list->StopRec = $employees_list->TotalRecs;
}
$employees_list->RecCnt = $employees_list->StartRec - 1;
if ($employees_list->Recordset && !$employees_list->Recordset->EOF) {
	$employees_list->Recordset->moveFirst();
	$selectLimit = $employees_list->UseSelectLimit;
	if (!$selectLimit && $employees_list->StartRec > 1)
		$employees_list->Recordset->move($employees_list->StartRec - 1);
} elseif (!$employees->AllowAddDeleteRow && $employees_list->StopRec == 0) {
	$employees_list->StopRec = $employees->GridAddRowCount;
}

// Initialize aggregate
$employees->RowType = ROWTYPE_AGGREGATEINIT;
$employees->resetAttributes();
$employees_list->renderRow();
while ($employees_list->RecCnt < $employees_list->StopRec) {
	$employees_list->RecCnt++;
	if ($employees_list->RecCnt >= $employees_list->StartRec) {
		$employees_list->RowCnt++;

		// Set up key count
		$employees_list->KeyCount = $employees_list->RowIndex;

		// Init row class and style
		$employees->resetAttributes();
		$employees->CssClass = "";
		if ($employees->isGridAdd()) {
		} else {
			$employees_list->loadRowValues($employees_list->Recordset); // Load row values
		}
		$employees->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$employees->RowAttrs = array_merge($employees->RowAttrs, array('data-rowindex'=>$employees_list->RowCnt, 'id'=>'r' . $employees_list->RowCnt . '_employees', 'data-rowtype'=>$employees->RowType));

		// Render row
		$employees_list->renderRow();

		// Render list options
		$employees_list->renderListOptions();
?>
	<tr<?php echo $employees->rowAttributes() ?>>
<?php

// Render list options (body, left)
$employees_list->ListOptions->render("body", "left", $employees_list->RowCnt);
?>
	<?php if ($employees->id->Visible) { // id ?>
		<td data-name="id"<?php echo $employees->id->cellAttributes() ?>>
<span id="el<?php echo $employees_list->RowCnt ?>_employees_id" class="employees_id">
<span<?php echo $employees->id->viewAttributes() ?>>
<?php echo $employees->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employees->name->Visible) { // name ?>
		<td data-name="name"<?php echo $employees->name->cellAttributes() ?>>
<span id="el<?php echo $employees_list->RowCnt ?>_employees_name" class="employees_name">
<span<?php echo $employees->name->viewAttributes() ?>>
<?php echo $employees->name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employees->address->Visible) { // address ?>
		<td data-name="address"<?php echo $employees->address->cellAttributes() ?>>
<span id="el<?php echo $employees_list->RowCnt ?>_employees_address" class="employees_address">
<span<?php echo $employees->address->viewAttributes() ?>>
<?php echo $employees->address->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employees->salary->Visible) { // salary ?>
		<td data-name="salary"<?php echo $employees->salary->cellAttributes() ?>>
<span id="el<?php echo $employees_list->RowCnt ?>_employees_salary" class="employees_salary">
<span<?php echo $employees->salary->viewAttributes() ?>>
<?php echo $employees->salary->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employees->photo->Visible) { // photo ?>
		<td data-name="photo"<?php echo $employees->photo->cellAttributes() ?>>
<span id="el<?php echo $employees_list->RowCnt ?>_employees_photo" class="employees_photo">
<span<?php echo $employees->photo->viewAttributes() ?>>
<?php echo $employees->photo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$employees_list->ListOptions->render("body", "right", $employees_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$employees->isGridAdd())
		$employees_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$employees->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($employees_list->Recordset)
	$employees_list->Recordset->Close();
?>
<?php if (!$employees->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$employees->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($employees_list->Pager)) $employees_list->Pager = new PrevNextPager($employees_list->StartRec, $employees_list->DisplayRecs, $employees_list->TotalRecs, $employees_list->AutoHidePager) ?>
<?php if ($employees_list->Pager->RecordCount > 0 && $employees_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($employees_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $employees_list->pageUrl() ?>start=<?php echo $employees_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($employees_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $employees_list->pageUrl() ?>start=<?php echo $employees_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $employees_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($employees_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $employees_list->pageUrl() ?>start=<?php echo $employees_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($employees_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $employees_list->pageUrl() ?>start=<?php echo $employees_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $employees_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($employees_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $employees_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $employees_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $employees_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php
	foreach ($employees_list->OtherOptions as &$option)
		$option->render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($employees_list->TotalRecs == 0 && !$employees->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php
	foreach ($employees_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$employees_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$employees->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$employees_list->terminate();
?>
