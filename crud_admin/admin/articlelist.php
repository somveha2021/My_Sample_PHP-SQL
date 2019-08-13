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
$article_list = new article_list();

// Run the page
$article_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$article_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$article->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var farticlelist = currentForm = new ew.Form("farticlelist", "list");
farticlelist.formKeyCountName = '<?php echo $article_list->FormKeyCountName ?>';

// Form_CustomValidate event
farticlelist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
farticlelist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
farticlelist.lists["x_category_id"] = <?php echo $article_list->category_id->Lookup->toClientList() ?>;
farticlelist.lists["x_category_id"].options = <?php echo JsonEncode($article_list->category_id->lookupOptions()) ?>;
farticlelist.lists["x_created_by"] = <?php echo $article_list->created_by->Lookup->toClientList() ?>;
farticlelist.lists["x_created_by"].options = <?php echo JsonEncode($article_list->created_by->lookupOptions()) ?>;
farticlelist.lists["x_status"] = <?php echo $article_list->status->Lookup->toClientList() ?>;
farticlelist.lists["x_status"].options = <?php echo JsonEncode($article_list->status->options(FALSE, TRUE)) ?>;

// Form object for search
var farticlelistsrch = currentSearchForm = new ew.Form("farticlelistsrch");

// Filters
farticlelistsrch.filterList = <?php echo $article_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$article->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($article_list->TotalRecs > 0 && $article_list->ExportOptions->visible()) { ?>
<?php $article_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($article_list->ImportOptions->visible()) { ?>
<?php $article_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($article_list->SearchOptions->visible()) { ?>
<?php $article_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($article_list->FilterOptions->visible()) { ?>
<?php $article_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$article_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$article->isExport() && !$article->CurrentAction) { ?>
<form name="farticlelistsrch" id="farticlelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($article_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="farticlelistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="article">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($article_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->Phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($article_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->Phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $article_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($article_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->Phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($article_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->Phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($article_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->Phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($article_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->Phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $article_list->showPageHeader(); ?>
<?php
$article_list->showMessage();
?>
<?php if ($article_list->TotalRecs > 0 || $article->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($article_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> article">
<form name="farticlelist" id="farticlelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($article_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $article_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="article">
<div id="gmp_article" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($article_list->TotalRecs > 0 || $article->isGridEdit()) { ?>
<table id="tbl_articlelist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$article_list->RowType = ROWTYPE_HEADER;

// Render list options
$article_list->renderListOptions();

// Render list options (header, left)
$article_list->ListOptions->render("header", "left");
?>
<?php if ($article->id->Visible) { // id ?>
	<?php if ($article->sortUrl($article->id) == "") { ?>
		<th data-name="id" class="<?php echo $article->id->headerCellClass() ?>"><div id="elh_article_id" class="article_id"><div class="ew-table-header-caption"><?php echo $article->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $article->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $article->SortUrl($article->id) ?>',1);"><div id="elh_article_id" class="article_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $article->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($article->id->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($article->id->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($article->category_id->Visible) { // category_id ?>
	<?php if ($article->sortUrl($article->category_id) == "") { ?>
		<th data-name="category_id" class="<?php echo $article->category_id->headerCellClass() ?>"><div id="elh_article_category_id" class="article_category_id"><div class="ew-table-header-caption"><?php echo $article->category_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="category_id" class="<?php echo $article->category_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $article->SortUrl($article->category_id) ?>',1);"><div id="elh_article_category_id" class="article_category_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $article->category_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($article->category_id->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($article->category_id->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($article->title->Visible) { // title ?>
	<?php if ($article->sortUrl($article->title) == "") { ?>
		<th data-name="title" class="<?php echo $article->title->headerCellClass() ?>"><div id="elh_article_title" class="article_title"><div class="ew-table-header-caption"><?php echo $article->title->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="title" class="<?php echo $article->title->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $article->SortUrl($article->title) ?>',1);"><div id="elh_article_title" class="article_title">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $article->title->caption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($article->title->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($article->title->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($article->photo->Visible) { // photo ?>
	<?php if ($article->sortUrl($article->photo) == "") { ?>
		<th data-name="photo" class="<?php echo $article->photo->headerCellClass() ?>"><div id="elh_article_photo" class="article_photo"><div class="ew-table-header-caption"><?php echo $article->photo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="photo" class="<?php echo $article->photo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $article->SortUrl($article->photo) ?>',1);"><div id="elh_article_photo" class="article_photo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $article->photo->caption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($article->photo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($article->photo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($article->created_by->Visible) { // created_by ?>
	<?php if ($article->sortUrl($article->created_by) == "") { ?>
		<th data-name="created_by" class="<?php echo $article->created_by->headerCellClass() ?>"><div id="elh_article_created_by" class="article_created_by"><div class="ew-table-header-caption"><?php echo $article->created_by->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="created_by" class="<?php echo $article->created_by->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $article->SortUrl($article->created_by) ?>',1);"><div id="elh_article_created_by" class="article_created_by">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $article->created_by->caption() ?></span><span class="ew-table-header-sort"><?php if ($article->created_by->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($article->created_by->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($article->created_date->Visible) { // created_date ?>
	<?php if ($article->sortUrl($article->created_date) == "") { ?>
		<th data-name="created_date" class="<?php echo $article->created_date->headerCellClass() ?>"><div id="elh_article_created_date" class="article_created_date"><div class="ew-table-header-caption"><?php echo $article->created_date->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="created_date" class="<?php echo $article->created_date->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $article->SortUrl($article->created_date) ?>',1);"><div id="elh_article_created_date" class="article_created_date">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $article->created_date->caption() ?></span><span class="ew-table-header-sort"><?php if ($article->created_date->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($article->created_date->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($article->status->Visible) { // status ?>
	<?php if ($article->sortUrl($article->status) == "") { ?>
		<th data-name="status" class="<?php echo $article->status->headerCellClass() ?>"><div id="elh_article_status" class="article_status"><div class="ew-table-header-caption"><?php echo $article->status->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="status" class="<?php echo $article->status->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $article->SortUrl($article->status) ?>',1);"><div id="elh_article_status" class="article_status">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $article->status->caption() ?></span><span class="ew-table-header-sort"><?php if ($article->status->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($article->status->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$article_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($article->ExportAll && $article->isExport()) {
	$article_list->StopRec = $article_list->TotalRecs;
} else {

	// Set the last record to display
	if ($article_list->TotalRecs > $article_list->StartRec + $article_list->DisplayRecs - 1)
		$article_list->StopRec = $article_list->StartRec + $article_list->DisplayRecs - 1;
	else
		$article_list->StopRec = $article_list->TotalRecs;
}
$article_list->RecCnt = $article_list->StartRec - 1;
if ($article_list->Recordset && !$article_list->Recordset->EOF) {
	$article_list->Recordset->moveFirst();
	$selectLimit = $article_list->UseSelectLimit;
	if (!$selectLimit && $article_list->StartRec > 1)
		$article_list->Recordset->move($article_list->StartRec - 1);
} elseif (!$article->AllowAddDeleteRow && $article_list->StopRec == 0) {
	$article_list->StopRec = $article->GridAddRowCount;
}

// Initialize aggregate
$article->RowType = ROWTYPE_AGGREGATEINIT;
$article->resetAttributes();
$article_list->renderRow();
while ($article_list->RecCnt < $article_list->StopRec) {
	$article_list->RecCnt++;
	if ($article_list->RecCnt >= $article_list->StartRec) {
		$article_list->RowCnt++;

		// Set up key count
		$article_list->KeyCount = $article_list->RowIndex;

		// Init row class and style
		$article->resetAttributes();
		$article->CssClass = "";
		if ($article->isGridAdd()) {
		} else {
			$article_list->loadRowValues($article_list->Recordset); // Load row values
		}
		$article->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$article->RowAttrs = array_merge($article->RowAttrs, array('data-rowindex'=>$article_list->RowCnt, 'id'=>'r' . $article_list->RowCnt . '_article', 'data-rowtype'=>$article->RowType));

		// Render row
		$article_list->renderRow();

		// Render list options
		$article_list->renderListOptions();
?>
	<tr<?php echo $article->rowAttributes() ?>>
<?php

// Render list options (body, left)
$article_list->ListOptions->render("body", "left", $article_list->RowCnt);
?>
	<?php if ($article->id->Visible) { // id ?>
		<td data-name="id"<?php echo $article->id->cellAttributes() ?>>
<span id="el<?php echo $article_list->RowCnt ?>_article_id" class="article_id">
<span<?php echo $article->id->viewAttributes() ?>>
<?php echo $article->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($article->category_id->Visible) { // category_id ?>
		<td data-name="category_id"<?php echo $article->category_id->cellAttributes() ?>>
<span id="el<?php echo $article_list->RowCnt ?>_article_category_id" class="article_category_id">
<span<?php echo $article->category_id->viewAttributes() ?>>
<?php echo $article->category_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($article->title->Visible) { // title ?>
		<td data-name="title"<?php echo $article->title->cellAttributes() ?>>
<span id="el<?php echo $article_list->RowCnt ?>_article_title" class="article_title">
<span<?php echo $article->title->viewAttributes() ?>>
<?php echo $article->title->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($article->photo->Visible) { // photo ?>
		<td data-name="photo"<?php echo $article->photo->cellAttributes() ?>>
<span id="el<?php echo $article_list->RowCnt ?>_article_photo" class="article_photo">
<span>
<?php echo GetFileViewTag($article->photo, $article->photo->getViewValue()) ?>
</span>
</span>
</td>
	<?php } ?>
	<?php if ($article->created_by->Visible) { // created_by ?>
		<td data-name="created_by"<?php echo $article->created_by->cellAttributes() ?>>
<span id="el<?php echo $article_list->RowCnt ?>_article_created_by" class="article_created_by">
<span<?php echo $article->created_by->viewAttributes() ?>>
<?php echo $article->created_by->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($article->created_date->Visible) { // created_date ?>
		<td data-name="created_date"<?php echo $article->created_date->cellAttributes() ?>>
<span id="el<?php echo $article_list->RowCnt ?>_article_created_date" class="article_created_date">
<span<?php echo $article->created_date->viewAttributes() ?>>
<?php echo $article->created_date->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($article->status->Visible) { // status ?>
		<td data-name="status"<?php echo $article->status->cellAttributes() ?>>
<span id="el<?php echo $article_list->RowCnt ?>_article_status" class="article_status">
<span<?php echo $article->status->viewAttributes() ?>>
<?php echo $article->status->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$article_list->ListOptions->render("body", "right", $article_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$article->isGridAdd())
		$article_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$article->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($article_list->Recordset)
	$article_list->Recordset->Close();
?>
<?php if (!$article->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$article->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($article_list->Pager)) $article_list->Pager = new PrevNextPager($article_list->StartRec, $article_list->DisplayRecs, $article_list->TotalRecs, $article_list->AutoHidePager) ?>
<?php if ($article_list->Pager->RecordCount > 0 && $article_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($article_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $article_list->pageUrl() ?>start=<?php echo $article_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($article_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $article_list->pageUrl() ?>start=<?php echo $article_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $article_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($article_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $article_list->pageUrl() ?>start=<?php echo $article_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($article_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $article_list->pageUrl() ?>start=<?php echo $article_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $article_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($article_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $article_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $article_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $article_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php
	foreach ($article_list->OtherOptions as &$option)
		$option->render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($article_list->TotalRecs == 0 && !$article->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php
	foreach ($article_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$article_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$article->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$article_list->terminate();
?>
