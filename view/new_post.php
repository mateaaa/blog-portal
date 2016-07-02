<?php require_once __SITE_PATH . '/view/_header.php'; ?>

<div class="row">
    <div class="col-md-12">

        <form role="form" method="POST" action="<?php echo __SITE_URL . '/profile/savePost' ?>">

            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" name="title">
            </div>
            <div class="form-group">
                <label for="text"></label>
                <textarea name="text"></textarea>
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
        </form>
    </div>
</div>

<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>
    $(document).ready(function() {
        tinymce.init({
          selector:'textarea',
          height: 300,
          plugins : 'advlist autolink link lists charmap print preview code save',
          toolbar: 'undo redo | bold italic | alignleft aligncenter alignright alignjustify | styleselect fontselect fontsizeselect | cut copy paste | bullist numlist outdent indent',
          statusbar: false
        });
    });
</script>

<?php require_once __SITE_PATH . '/view/_footer.php'; ?>
