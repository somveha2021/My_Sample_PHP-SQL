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
$users_list = new users_list();

// Run the page
$users_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$users_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$users->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fuserslist = currentForm = new ew.Form("fuserslist", "list");
fuserslist.formKeyCountName = '<?php echo $users_list->FormKeyCountName ?>';

// Form_CustomValidate event
fuserslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fuserslist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fuserslistsrch = currentSearchForm = new ew.Form("fuserslistsrch");

// Filters
fuserslistsrch.filterList = <?php echo $users_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$users->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($users_list->TotalRecs > 0 && $users_list->ExportOptions->visible()) { ?>
<?php $users_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($users_list->ImportOptions->visible()) { ?>
<?php $users_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($users_list->SearchOptions->visible()) { ?>
<?php $users_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($users_list->FilterOptions->visible()) { ?>
<?php $users_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$users_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$users->isExport() && !$users->CurrentAction) { ?>
<form name="fuserslistsrch" id="fuserslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($users_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fuserslistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="users">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($users_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->Phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($users_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->Phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $users_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($users_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->Phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($users_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->Phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($users_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->Phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($users_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->Phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $users_list->showPageHeader(); ?>
<?php
$users_list->showMessage();
?>
<?php if ($users_list->TotalRecs > 0 || $users->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($users_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> users">
<form name="fuserslist" id="fuserslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($users_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $users_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="users">
<div id="gmp_users" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($users_list->TotalRecs > 0 || $users->isGridEdit()) { ?>
<table id="tbl_userslist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$users_list->RowType = ROWTYPE_HEADER;

// Render list options
$users_list->renderListOptions();

// Render list options (header, left)
$users_list->ListOptions->render("header", "left");
?>
<?php if ($users->id->Visible) { // id ?>
	<?php if ($users->sortUrl($users->id) == "") { ?>
		<th data-name="id" class="<?php echo $users->id->headerCellClass() ?>"><div id="elh_users_id" class="users_id"><div class="ew-table-header-caption"><?php echo $users->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $users->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $users->SortUrl($users->id) ?>',1);"><div id="elh_users_id" class="users_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $users->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($users->id->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($users->id->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($users->username->Visible) { // username ?>
	<?php if ($users->sortUrl($users->username) == "") { ?>
		<th data-name="username" class="<?php echo $users->username->headerCellClass() ?>"><div id="elh_users_username" class="users_username"><div class="ew-table-header-caption"><?php echo $users->username->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="username" class="<?php echo $users->username->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $users->SortUrl($users->username) ?>',1);"><div id="elh_users_username" class="users_username">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $users->username->caption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($users->username->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($users->username->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($users->full_name->Visible) { // full_name ?>
	<?php if ($users->sortUrl($users->full_name) == "") { ?>
		<th data-name="full_name" class="<?php echo $users->full_name->headerCellClass() ?>"><div id="elh_users_full_name" class="users_full_name"><div class="ew-table-header-caption"><?php echo $users->full_name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="full_name" class="<?php echo $users->full_name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $users->SortUrl($users->full_name) ?>',1);"><div id="elh_users_full_name" class="users_full_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $users->full_name->caption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($users->full_name->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($users->full_name->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($users->password->Visible) { // password ?>
	<?php if ($users->sortUrl($users->password) == "") { ?>
		<th data-name="password" class="<?php echo $users->password->headerCellClass() ?>"><div id="elh_users_password" class="users_password"><div class="ew-table-header-caption"><?php echo $users->password->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="password" class="<?php echo $users->password->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $users->SortUrl($users->password) ?>',1);"><div id="elh_users_password" class="users_password">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $users->password->caption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($users->password->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($users->password->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($users->created_at->Visible) { // created_at ?>
	<?php if ($users->sortUrl($users->created_at) == "") { ?>
		<th data-name="created_at" class="<?php echo $users->created_at->headerCellClass() ?>"><div id="elh_users_created_at" class="users_created_at"><div class="ew-table-header-caption"><?php echo $users->created_at->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="created_at" class="<?php echo $users->created_at->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $users->SortUrl($users->created_at) ?>',1);"><div id="elh_users_created_at" class="users_created_at">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $users->created_at->caption() ?></span><span class="ew-table-header-sort"><?php if ($users->created_at->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($users->created_at->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($users->group_id->Visible) { // group_id ?>
	<?php if ($users->sortUrl($users->group_id) == "") { ?>
		<th data-name="group_id" class="<?php echo $users->group_id->headerCellClass() ?>"><div id="elh_users_group_id" class="users_group_id"><div class="ew-table-header-caption"><?php echo $users->group_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="group_id" class="<?php echo $users->group_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $users->SortUrl($users->group_id) ?>',1);"><div id="elh_users_group_id" class="users_group_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $users->group_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($users->group_id->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($users->group_id->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$users_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($users->ExportAll && $users->isExport()) {
	$users_list->StopRec = $users_list->TotalRecs;
} else {

	// Set the last record to display
	if ($users_list->TotalRecs > $users_list->StartRec + $users_list->DisplayRecs - 1)
		$users_list->StopRec = $users_list->StartRec + $users_list->DisplayRecs - 1;
	else
		$users_list->StopRec = $users_list->TotalRecs;
}
$users_list->RecCnt = $users_list->StartRec - 1;
if ($users_list->Recordset && !$users_list->Recordset->EOF) {
	$users_list->Recordset->moveFirst();
	$selectLimit = $users_list->UseSelectLimit;
	if (!$selectLimit && $users_list->StartRec > 1)
		$users_list->Recordset->move($users_list->StartRec - 1);
} elseif (!$users->AllowAddDeleteRow && $users_list->StopRec == 0) {
	$users_list->StopRec = $users->GridAddRowCount;
}

// Initialize aggregate
$users->RowType = ROWTYPE_AGGREGATEINIT;
$users->resetAttributes();
$users_list->renderRow();
while ($users_list->RecCnt < $users_list->StopRec) {
	$users_list->RecCnt++;
	if ($users_list->RecCnt >= $users_list->StartRec) {
		$users_list->RowCnt++;

		// Set up key count
		$users_list->KeyCount = $users_list->RowIndex;

		// Init row class and style
		$users->resetAttributes();
		$users->CssClass = "";
		if ($users->isGridAdd()) {
		} else {
			$users_list->loadRowValues($users_list->Recordset); // Load row values
		}
		$users->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$users->RowAttrs = array_merge($users->RowAttrs, array('data-rowindex'=>$users_list->RowCnt, 'id'=>'r' . $users_list->RowCnt . '_users', 'data-rowtype'=>$users->RowType));

		// Render row
		$users_list->renderRow();

		// Render list options
		$users_list->renderListOptions();
?>
	<tr<?php echo $users->rowAttributes() ?>>
<?php

// Render list options (body, left)
$users_list->ListOptions->render("body", "left", $users_list->RowCnt);
?>
	<?php if ($users->id->Visible) { // id ?>
		<td data-name="id"<?php echo $users->id->cellAttributes() ?>>
<span id="el<?php echo $users_list->RowCnt ?>_users_id" class="users_id">
<span<?php echo $users->id->viewAttributes() ?>>
<?php echo $users->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($users->username->Visible) { // username ?>
		<td data-name="username"<?php echo $users->username->cellAttributes() ?>>
<span id="el<?php echo $users_list->RowCnt ?>_users_username" class="users_username">
<span<?php echo $users->username->viewAttributes() ?>>
<?php echo $users->username->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($users->full_name->Visible) { // full_name ?>
		<td data-name="full_name"<?php echo $users->full_name->cellAttributes() ?>>
<span id="el<?php echo $users_list->RowCnt ?>_users_full_name" class="users_full_name">
<span<?php echo $users->full_name->viewAttributes() ?>>
<?php echo $users->full_name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($users->password->Visible) { // password ?>
		<td data-name="password"<?php echo $users->password->cellAttributes() ?>>
<span id="el<?php echo $users_list->RowCnt ?>_users_password" class="users_password">
<span<?php echo $users->password->viewAttributes() ?>>
<?php echo $users->password->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($users->created_at->Visible) { // created_at ?>
		<td data-name="created_at"<?php echo $users->created_at->cellAttributes() ?>>
<span id="el<?php echo $users_list->RowCnt ?>_users_created_at" class="users_created_at">
<span<?php echo $users->created_at->viewAttributes() ?>>
<?php echo $users->created_at->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($users->group_id->Visible) { // group_id ?>
		<td data-name="group_id"<?php echo $users->group_id->cellAttributes() ?>>
<span id="el<?php echo $users_list->RowCnt ?>_users_group_id" class="users_group_id">
<span<?php echo $users->group_id->viewAttributes() ?>>
<?php echo $users->group_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$users_list->ListOptions->render("body", "right", $users_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$users->isGridAdd())
		$users_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$users->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($users_list->Recordset)
	$users_list->Recordset->Close();
?>
<?php if (!$users->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$users->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($users_list->Pager)) $users_list->Pager = new PrevNextPager($users_list->StartRec, $users_list->DisplayRecs, $users_list->TotalRecs, $users_list->AutoHidePager) ?>
<?php if ($users_list->Pager->RecordCount > 0 && $users_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($users_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $users_list->pageUrl() ?>start=<?php echo $users_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($users_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $users_list->pageUrl() ?>start=<?php echo $users_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $users_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($users_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $users_list->pageUrl() ?>start=<?php echo $users_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($users_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $users_list->pageUrl() ?>start=<?php echo $users_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $users_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($users_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $users_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $users_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $users_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php
	foreach ($users_list->OtherOptions as &$option)
		$option->render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($users_list->TotalRecs == 0 && !$users->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php
	foreach ($users_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$users_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$users->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$users_list->terminate();
?>
