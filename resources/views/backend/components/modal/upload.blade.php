<div class="modal" id="upload-modal" tabindex="-1" role="dialog" aria-labelledby=updateModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">上传文件</h4>
            </div>
            <div class="modal-body">
                <form enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="form-group">
                        <input id="file-1" type="file" multiple class="file" data-overwrite-initial="false">
                    </div>
                    {{--<div class="modal-footer">
                       --}}{{-- <button class="btn btn-info" id="upload-finished">确定</button>
                        <button class="btn btn-default" type="reset">重置</button>--}}{{--
                        --}}{{--<button type="button" class="btn btn-default btn-flat" id="upload-finished">刷新</button>--}}{{--
                    </div>--}}
                </form>
            </div>

        </div>
    </div>
</div>
<script type="text/javascript" src="/assets/backend/plugins/fileinput/js/fileinput.js"></script>
<script type="text/javascript" src="/assets/backend/plugins/fileinput/js/locales/zh.js"></script>
<script>
    $('#upload-finished').click(function () {
        $('#upload-finished').modal('hide');
        location.reload();
    });
    $("#file-1").fileinput({
        language:'zh',
        uploadUrl:'{{route('backend.file.upload')}}',
        autoReplace: true,
        overwriteInitial: true,
        maxFileCount: 1,
        uploadExtraData:{_token:'{{csrf_token()}}'},
        paramName: "file",
        allowedFileExtensions :['jpg', 'gif', 'png', 'jpeg', 'zip', 'rar', 'tar', 'gz', '7z', 'doc', 'docx', 'txt', 'xml'],
        overwriteInitial: false,
        maxFileSize: 10 * 1024 * 1024,

        /*showPreview: false,*/
        //allowedFileTypes: ['image', 'video', 'flash'],
    });


</script>
