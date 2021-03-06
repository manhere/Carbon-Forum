<?php
if (!defined('InternalAccess')) exit('error: 403 Access Denied');
?>
<!-- this is the header div at the top -->
<div id="header">
	<a href="javascript:$.ui.toggleLeftSideMenu()" class="button" style="float:left">Toggle Nav</a>
</div>
<div id="content">
	<!-- here is where you can add your panels -->
	<div data-title="<?php echo $PageTitle; ?>" id="main" class="panel" selected="true">
		<ul class="list topic-list">
		<?php
		foreach ($TopicsArray as $Topic) {
		?>
			<li>
				<div class="avatar">
					<a href="<?php echo $Config['WebsitePath']; ?>/u/<?php echo $Topic['UserName'] ?>" target="_blank">
							<?php echo GetAvatar($Topic['UserID'], $Topic['UserName'], 'middle'); ?>
					</a>
				</div>
				<div class="content">
				<a href="<?php echo $Config['WebsitePath']; ?>/t/<?php echo $Topic['ID']; ?>" data-transition="slide" data-persist-ajax="true"><h2><?php echo $Topic['Topic']; ?></h2></a>
				<p>
				<?php
				if($Topic['Tags']){
					foreach (explode("|", $Topic['Tags']) as $Tag) {
					?>
					<a href="<?php echo $Config['WebsitePath']; ?>/tag/<?php echo urlencode($Tag); ?>" target="_blank"><?php echo $Tag; ?></a>
				<?php }
				} ?>
				
					<?php echo $Lang['Last_Reply_From']; ?>&nbsp;<a href="<?php echo $Config['WebsitePath']; ?>/u/<?php echo $Topic['LastName'] ?>" target="_blank"><?php echo $Topic['LastName']; ?></a>
				</p>
				<?php if($Topic['Replies']){ ?>
				<p class="aside">
					<a href="<?php echo $Config['WebsitePath']; ?>/t/<?php echo $Topic['ID']; ?>"><?php echo $Topic['Replies']; ?></a>
				</p>
				<?php } ?>
				</div>
			</li>
		<?php } ?>
		</ul>
	<?php Pagination("/page/",$Page,$TotalPage); ?>
	</div>
</div>

<!-- bottom navbar. Add additional tabs here -->
<div id="navbar" style="height:0;"></div>
<!-- this is the default left side nav menu.  If you do not want any, do not include these -->
<nav>
	<!--header class="header"><h1>Left Menu</h1></header-->
	<ul class="list">
		<?php include($TemplatePath.'sider.php'); ?>
		<li class="divider"><?php echo $Lang['Website_Statistics']; ?></li>
		<li><?php echo $Lang['Topics_Number']; ?>：<?php echo $Config['NumTopics']; ?></li>
		<li><?php echo $Lang['Posts_Number']; ?>：<?php echo $Config['NumPosts']; ?></li>
		<li><?php echo $Lang['Tags_Number']; ?>：<?php echo $Config['NumTags']; ?></li>
		<li><?php echo $Lang['Users_Number']; ?>：<?php echo $Config['NumUsers']; ?></li>
	</ul>
</nav>