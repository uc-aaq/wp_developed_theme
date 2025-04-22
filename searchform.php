<!-- searchform.php -->
<form action="<?php echo esc_url(home_url('/')); ?>" method="GET" class="input-group">
    <input type="text" name="s" class="form-control" placeholder="Search..." value="<?php echo get_search_query(); ?>" required>
    <button type="button" class="btn-close" id="closeSearchBox"></button>
    <button type="submit" class="btn btn-primary">
        <i class="bx bx-search"></i>
    </button>
</form>