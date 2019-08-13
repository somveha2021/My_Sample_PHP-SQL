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
$group_list = new group_list();

// Run the page
$group_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$group_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$group->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fgrouplist = currentForm = new ew.Form("fgrouplist", "list");
fgrouplist.formKeyCountName = '<?php echo $group_list->FormKeyCountName ?>';

// Form_CustomValidate event
fgrouplist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fgrouplist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fgrouplistsrch = currentSearchForm = new ew.Form("fgrouplistsrch");

// Filters
fgrouplistsrch.filterList = <?php echo $group_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$group->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($group_list->TotalRecs > 0 && $group_list->ExportOptions->visible()) { ?>
<?php $group_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($group_list->ImportOptions->visible()) { ?>
<?php $group_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($group_list->SearchOptions->visible()) { ?>
<?php $group_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($group_list->FilterOptions->visible()) { ?>
<?php $group_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$group_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$group->isExport() && !$group->CurrentAction) { ?>
<form name="fgrouplistsrch" id="fgrouplistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($group_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fgrouplistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="group">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($group_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->Phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($group_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->Phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $group_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($group_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->Phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($group_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->Phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($group_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->Phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($group_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->Phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $group_list->showPageHeader(); ?>
<?php
$group_list->showMessage();
?>
<?php if ($group_list->TotalRecs > 0 || $group->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($group_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> group">
<form name="fgrouplist" id="fgrouplist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($group_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $group_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="group">
<div id="gmp_group" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($group_list->TotalRecs > 0 || $group->isGridEdit()) { ?>
<table id="tbl_grouplist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$group_list->RowType = ROWTYPE_HEADER;

// Render list options
$group_list->renderListOptions();

// Render list options (header, left)
$group_list->ListOptions->render("header", "left");
?>
<?php if ($group->id->Visible) { // id ?>
	<?php if ($group->sortUrl($group->id) == "") { ?>
		<th data-name="id" class="<?php echo $group->id->headerCellClass() ?>"><div id="elh_group_id" class="group_id"><div class="ew-table-header-caption"><?php echo $group->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $group->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $group->SortUrl($group->id) ?>',1);"><div id="elh_group_id" class="group_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $group->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($group->id->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($group->id->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($group->name->Visible) { // name ?>
	<?php if ($group->sortUrl($group->name) == "") { ?>
		<th data-name="name" class="<?php echo $group->name->headerCellClass() ?>"><div id="elh_group_name" class="group_name"><div class="ew-table-header-caption"><?php echo $group->name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="name" class="<?php echo $group->name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $group->SortUrl($group->name) ?>',1);"><div id="elh_group_name" class="group_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $group->name->caption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($group->name->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($group->name->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($group->role->Visible) { // role ?>
	<?php if ($group->sortUrl($group->role) == "") { ?>
		<th data-name="role" class="<?php echo $group->role->headerCellClass() ?>"><div id="elh_group_role" class="group_role"><div class="ew-table-header-caption"><?php echo $group->role->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="role" class="<?php echo $group->role->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $group->SortUrl($group->role) ?>',1);"><div id="elh_group_role" class="group_role">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $group->role->caption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($group->role->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($group->role->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$group_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($group->ExportAll && $group->isExport()) {
	$group_list->StopRec = $group_list->TotalRecs;
} else {

	// Set the last record to display
	if ($group_list->TotalRecs > $group_list->StartRec + $group_list->DisplayRecs - 1)
		$group_list->StopRec = $group_list->StartRec + $group_list->DisplayRecs - 1;
	else
		$group_list->StopRec = $group_list->TotalRecs;
}
$group_list->RecCnt = $group_list->StartRec - 1;
if ($group_list->Recordset && !$group_list->Recordset->EOF) {
	$group_list->Recordset->moveFirst();
	$selectLimit = $group_list->UseSelectLimit;
	if (!$selectLimit && $group_list->StartRec > 1)
		$group_list->Recordset->move($group_list->StartRec - 1);
} elseif (!$group->AllowAddDeleteRow && $group_list->StopRec == 0) {
	$group_list->StopRec = $group->GridAddRowCount;
}

// Initialize aggregate
$group->RowType = ROWTYPE_AGGREGATEINIT;
$group->resetAttributes();
$group_list->renderRow();
while ($group_list->RecCnt < $group_list->StopRec) {
	$group_list->RecCnt++;
	if ($group_list->RecCnt >= $group_list->StartRec) {
		$group_list->RowCnt++;

		// Set up key count
		$group_list->KeyCount = $group_list->RowIndex;

		// Init row class and style
		$group->resetAttributes();
		$group->CssClass = "";
		if ($group->isGridAdd()) {
		} else {
			$group_list->loadRowValues($group_list->Recordset); // Load row values
		}
		$group->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$group->RowAttrs = array_merge($group->RowAttrs, array('data-rowindex'=>$group_list->RowCnt, 'id'=>'r' . $group_list->RowCnt . '_group', 'data-rowtype'=>$group->RowType));

		// Render row
		$group_list->renderRow();

		// Render list options
		$group_list->renderListOptions();
?>
	<tr<?php echo $group->rowAttributes() ?>>
<?php

// Render list options (body, left)
$group_list->ListOptions->render("body", "left", $group_list->RowCnt);
?>
	<?php if ($group->id->Visible) { // id ?>
		<td data-name="id"<?php echo $group->id->cellAttributes() ?>>
<span id="el<?php echo $group_list->RowCnt ?>_group_id" class="group_id">
<span<?php echo $group->id->viewAttributes() ?>>
<?php echo $group->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($group->name->Visible) { // name ?>
		<td data-name="name"<?php echo $group->name->cellAttributes() ?>>
<span id="el<?php echo $group_list->RowCnt ?>_group_name" class="group_name">
<span<?php echo $group->name->viewAttributes() ?>>
<?php echo $group->name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($group->role->Visible) { // role ?>
		<td data-name="role"<?php echo $group->role->cellAttributes() ?>>
<span id="el<?php echo $group_list->RowCnt ?>_group_role" class="group_role">
<span<?php echo $group->role->viewAttributes() ?>>
<?php echo $group->role->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$group_list->ListOptions->render("body", "right", $group_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$group->isGridAdd())
		$group_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$group->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($group_list->Recordset)
	$group_list->Recordset->Close();
?>
<?php if (!$group->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$group->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($group_list->Pager)) $group_list->Pager = new PrevNextPager($group_list->StartRec, $group_list->DisplayRecs, $group_list->TotalRecs, $group_list->AutoHidePager) ?>
<?php if ($group_list->Pager->RecordCount > 0 && $group_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($group_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $group_list->pageUrl() ?>start=<?php echo $group_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($group_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $group_list->pageUrl() ?>start=<?php echo $group_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $group_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($group_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $group_list->pageUrl() ?>start=<?php echo $group_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($group_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $group_list->pageUrl() ?>start=<?php echo $group_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $group_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($group_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $group_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $group_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $group_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php
	foreach ($group_list->OtherOptions as &$option)
		$option->render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($group_list->TotalRecs == 0 && !$group->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php
	foreach ($group_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$group_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$group->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$group_list->terminate();
?>
