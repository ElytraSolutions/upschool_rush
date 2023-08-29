<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Lesson Page Builder</title>
    <meta content="Best Free Open Source Responsive Websites Builder" name="description">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://unpkg.com/grapesjs/dist/css/grapes.min.css">
    <script src="https://unpkg.com/grapesjs/dist/grapes.min.js"></script>

    <script src="https://unpkg.com/grapesjs-blocks-basic"></script>
    <script src="https://unpkg.com/grapesjs-plugin-forms@2.0.5"></script>
    <script src="https://unpkg.com/grapesjs-preset-webpage@1.0.2"></script>
    <script src="https://unpkg.com/grapesjs-style-gradient"></script>
    <script src="https://unpkg.com/grapesjs-style-bg"></script>
    <script src="https://unpkg.com/grapesjs-tooltip"></script>
    <script src="https://unpkg.com/grapesjs-tabs"></script>

  </head>
  <body>
    <div class="{{$viewClass['form-group']}}">
        <label for="{{$id}}" class="{{$viewClass['label']}} control-label">{{$label}}
            </label><br>
        <div id="gjs" style="margin-top:10px"></div>
    </div>


    <script type="text/javascript">
        window.addEventListener('load', function () {
            var editor = grapesjs.init({
                container : '#gjs',
                plugins: [
                    "gjs-blocks-basic",
                    'grapesjs-plugin-forms',
                    "grapesjs-preset-webpage",
                    "grapesjs-style-gradient",
                    "grapesjs-style-bg",
                    "grapesjs-tooltip",
                    "grapesjs-tabs",
                ],
                pluginsOpts: {
                    "grapesjs-tabs": {
                        tabsBlock: {
                            category: 'Extra'
                        }
                    },
                }
            });
            @if(isset($lesson))
            {
                editor.loadProjectData($lesson->content_json);
            }
            @endif

            var panels = editor.Panels;
            var cmdm = editor.Commands;

            optPanel = panels.getPanel('options');
            window.editor = editor;
            panels.addButton('options', {
                id: 'customSaveButton',
                className: 'fa fa-floppy-o',
                command: function() {
                    const html = editor.getHtml();
                    const css = editor.getCss();
                    const js = editor.getJs();
                    const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
                    fetch("/admin/tempLesson", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            "X-CSRF-Token": csrfToken,
                        },
                        data: JSON.stringify({html, css, js, content_json: editor.getProjectData()}),
                    }).then(data => data.json()).then(data => {
                        window.location.href = '/admin/lessons/' + data.lessonId + '/edit';
                    })
                },
                attributes: {
                    title: 'Save Template'
                },
            })
            console.log(optPanel)
        }); // end of event listener
    </script>
  </body>
</html>
