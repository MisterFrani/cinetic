     <!-- Page Content  -->
<div id="content-page" class="content-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 row m-auto p-0">
                <div class="col-sm-12"><?php include('components/publish.php'); ?></div>
                <?php foreach($posts as $item){ include('components/card-post.php');} ?>
            </div>
        </div>
    </div>
</div>