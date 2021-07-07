<html>
    <body>
        <form action="{{url('/')}}/create_post" enctype="multipart/form-data" method="post" class="icons-tab-steps wizard-notification">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <label>comment</label><input type="text" name="comment">
            <button type="submit">post</button>
        </form>
    </body>
</html>
