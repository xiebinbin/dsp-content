<div class="{{$viewClass['form-group']}}">
    <label class="{{$viewClass['label']}} control-label">{{$label}}</label>

    <div class="{{$viewClass['field']}}" style="height: 500px;overflow-y: auto;">

        @include('admin::form.error')

        <div {!! $attributes !!} style="width: 100%; height: 100%;">
        </div>

        <input type="hidden" name="{{$name}}" value="{{ old($column, $value) }}" />

        @include('admin::form.help-block')

    </div>
</div>
<script require="@editorjs" init="{!! $selector !!}">
    var E = window.EditorJS
    let data = {!! $value ?? '{}' !!};
    var editor = new E({
        placeholder: 'Let`s write an awesome story!',
        //inlineToolbar: ['bold', 'italic', 'underline'],
        // 初始化
        data,
        holder: id,
        onChange: () => {
            editor.save().then((outputData) => {
                $this.parents('.form-field').find('input[type="hidden"]').val(JSON.stringify(outputData));
            }).catch((error) => {
                console.log('Saving failed: ', error)
            })
        },
        tools: {
            image: {
                class: window.ImageTool,
                config: {
                    field: 'file',
                    endpoints: {
                        byFile: '/admin/file/upload-by-file', // Your backend file uploader endpoint
                        byUrl: '/admin/file/upload-by-url', // Your endpoint that provides uploading by Url
                    }
                }
            },
        },
    });
</script>