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
$students_list = new students_list();

// Run the page
$students_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$students_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$students->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fstudentslist = currentForm = new ew.Form("fstudentslist", "list");
fstudentslist.formKeyCountName = '<?php echo $students_list->FormKeyCountName ?>';

// Form_CustomValidate event
fstudentslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fstudentslist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fstudentslistsrch = currentSearchForm = new ew.Form("fstudentslistsrch");

// Filters
fstudentslistsrch.filterList = <?php echo $students_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$students->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($students_list->TotalRecs > 0 && $students_list->ExportOptions->visible()) { ?>
<?php $students_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($students_list->ImportOptions->visible()) { ?>
<?php $students_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($students_list->SearchOptions->visible()) { ?>
<?php $students_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($students_list->FilterOptions->visible()) { ?>
<?php $students_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$students_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$students->isExport() && !$students->CurrentAction) { ?>
<form name="fstudentslistsrch" id="fstudentslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($students_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fstudentslistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="students">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($students_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->Phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($students_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->Phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $students_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($students_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->Phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($students_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->Phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($students_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->Phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($students_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->Phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $students_list->showPageHeader(); ?>
<?php
$students_list->showMessage();
?>
<?php if ($students_list->TotalRecs > 0 || $students->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($students_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> students">
<form name="fstudentslist" id="fstudentslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($students_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $students_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="students">
<div id="gmp_students" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($students_list->TotalRecs > 0 || $students->isGridEdit()) { ?>
<table id="tbl_studentslist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$students_list->RowType = ROWTYPE_HEADER;

// Render list options
$students_list->renderListOptions();

// Render list options (header, left)
$students_list->ListOptions->render("header", "left");
?>
<?php if ($students->stu_id->Visible) { // stu_id ?>
	<?php if ($students->sortUrl($students->stu_id) == "") { ?>
		<th data-name="stu_id" class="<?php echo $students->stu_id->headerCellClass() ?>"><div id="elh_students_stu_id" class="students_stu_id"><div class="ew-table-header-caption"><?php echo $students->stu_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="stu_id" class="<?php echo $students->stu_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $students->SortUrl($students->stu_id) ?>',1);"><div id="elh_students_stu_id" class="students_stu_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $students->stu_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($students->stu_id->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($students->stu_id->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($students->name->Visible) { // name ?>
	<?php if ($students->sortUrl($students->name) == "") { ?>
		<th data-name="name" class="<?php echo $students->name->headerCellClass() ?>"><div id="elh_students_name" class="students_name"><div class="ew-table-header-caption"><?php echo $students->name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="name" class="<?php echo $students->name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $students->SortUrl($students->name) ?>',1);"><div id="elh_students_name" class="students_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $students->name->caption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($students->name->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($students->name->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($students->gender->Visible) { // gender ?>
	<?php if ($students->sortUrl($students->gender) == "") { ?>
		<th data-name="gender" class="<?php echo $students->gender->headerCellClass() ?>"><div id="elh_students_gender" class="students_gender"><div class="ew-table-header-caption"><?php echo $students->gender->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="gender" class="<?php echo $students->gender->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $students->SortUrl($students->gender) ?>',1);"><div id="elh_students_gender" class="students_gender">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $students->gender->caption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($students->gender->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($students->gender->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($students->bod->Visible) { // bod ?>
	<?php if ($students->sortUrl($students->bod) == "") { ?>
		<th data-name="bod" class="<?php echo $students->bod->headerCellClass() ?>"><div id="elh_students_bod" class="students_bod"><div class="ew-table-header-caption"><?php echo $students->bod->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="bod" class="<?php echo $students->bod->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $students->SortUrl($students->bod) ?>',1);"><div id="elh_students_bod" class="students_bod">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $students->bod->caption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($students->bod->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($students->bod->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($students->pob->Visible) { // pob ?>
	<?php if ($students->sortUrl($students->pob) == "") { ?>
		<th data-name="pob" class="<?php echo $students->pob->headerCellClass() ?>"><div id="elh_students_pob" class="students_pob"><div class="ew-table-header-caption"><?php echo $students->pob->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pob" class="<?php echo $students->pob->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $students->SortUrl($students->pob) ?>',1);"><div id="elh_students_pob" class="students_pob">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $students->pob->caption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($students->pob->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($students->pob->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$students_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($students->ExportAll && $students->isExport()) {
	$students_list->StopRec = $students_list->TotalRecs;
} else {

	// Set the last record to display
	if ($students_list->TotalRecs > $students_list->StartRec + $students_list->DisplayRecs - 1)
		$students_list->StopRec = $students_list->StartRec + $students_list->DisplayRecs - 1;
	else
		$students_list->StopRec = $students_list->TotalRecs;
}
$students_list->RecCnt = $students_list->StartRec - 1;
if ($students_list->Recordset && !$students_list->Recordset->EOF) {
	$students_list->Recordset->moveFirst();
	$selectLimit = $students_list->UseSelectLimit;
	if (!$selectLimit && $students_list->StartRec > 1)
		$students_list->Recordset->move($students_list->StartRec - 1);
} elseif (!$students->AllowAddDeleteRow && $students_list->StopRec == 0) {
	$students_list->StopRec = $students->GridAddRowCount;
}

// Initialize aggregate
$students->RowType = ROWTYPE_AGGREGATEINIT;
$students->resetAttributes();
$students_list->renderRow();
while ($students_list->RecCnt < $students_list->StopRec) {
	$students_list->RecCnt++;
	if ($students_list->RecCnt >= $students_list->StartRec) {
		$students_list->RowCnt++;

		// Set up key count
		$students_list->KeyCount = $students_list->RowIndex;

		// Init row class and style
		$students->resetAttributes();
		$students->CssClass = "";
		if ($students->isGridAdd()) {
		} else {
			$students_list->loadRowValues($students_list->Recordset); // Load row values
		}
		$students->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$students->RowAttrs = array_merge($students->RowAttrs, array('data-rowindex'=>$students_list->RowCnt, 'id'=>'r' . $students_list->RowCnt . '_students', 'data-rowtype'=>$students->RowType));

		// Render row
		$students_list->renderRow();

		// Render list options
		$students_list->renderListOptions();
?>
	<tr<?php echo $students->rowAttributes() ?>>
<?php

// Render list options (body, left)
$students_list->ListOptions->render("body", "left", $students_list->RowCnt);
?>
	<?php if ($students->stu_id->Visible) { // stu_id ?>
		<td data-name="stu_id"<?php echo $students->stu_id->cellAttributes() ?>>
<span id="el<?php echo $students_list->RowCnt ?>_students_stu_id" class="students_stu_id">
<span<?php echo $students->stu_id->viewAttributes() ?>>
<?php echo $students->stu_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($students->name->Visible) { // name ?>
		<td data-name="name"<?php echo $students->name->cellAttributes() ?>>
<span id="el<?php echo $students_list->RowCnt ?>_students_name" class="students_name">
<span<?php echo $students->name->viewAttributes() ?>>
<?php echo $students->name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($students->gender->Visible) { // gender ?>
		<td data-name="gender"<?php echo $students->gender->cellAttributes() ?>>
<span id="el<?php echo $students_list->RowCnt ?>_students_gender" class="students_gender">
<span<?php echo $students->gender->viewAttributes() ?>>
<?php echo $students->gender->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($students->bod->Visible) { // bod ?>
		<td data-name="bod"<?php echo $students->bod->cellAttributes() ?>>
<span id="el<?php echo $students_list->RowCnt ?>_students_bod" class="students_bod">
<span<?php echo $students->bod->viewAttributes() ?>>
<?php echo $students->bod->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($students->pob->Visible) { // pob ?>
		<td data-name="pob"<?php echo $students->pob->cellAttributes() ?>>
<span id="el<?php echo $students_list->RowCnt ?>_students_pob" class="students_pob">
<span<?php echo $students->pob->viewAttributes() ?>>
<?php echo $students->pob->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$students_list->ListOptions->render("body", "right", $students_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$students->isGridAdd())
		$students_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$students->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($students_list->Recordset)
	$students_list->Recordset->Close();
?>
<?php if (!$students->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$students->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($students_list->Pager)) $students_list->Pager = new PrevNextPager($students_list->StartRec, $students_list->DisplayRecs, $students_list->TotalRecs, $students_list->AutoHidePager) ?>
<?php if ($students_list->Pager->RecordCount > 0 && $students_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($students_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $students_list->pageUrl() ?>start=<?php echo $students_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($students_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $students_list->pageUrl() ?>start=<?php echo $students_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $students_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($students_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $students_list->pageUrl() ?>start=<?php echo $students_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($students_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $students_list->pageUrl() ?>start=<?php echo $students_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $students_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($students_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $students_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $students_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $students_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php
	foreach ($students_list->OtherOptions as &$option)
		$option->render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($students_list->TotalRecs == 0 && !$students->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php
	foreach ($students_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$students_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$students->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$students_list->terminate();
?>
