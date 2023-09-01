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
  <body style="height:100vh; margin: 0">
    <div id="gjs" style=""></div>
    <script type="text/javascript">
        window.addEventListener('load', async function () {
            const searchParams = new URLSearchParams(window.location.search);
            const id = searchParams.get('id');
            const queryParam = searchParams.get('queryParam');
            if(!id) {
                alert('No lesson id provided');
                return;
            }
            let response = await fetch(`/admin/api/richContents/${id}`);
            if(response.status === 404) {
                console.log("Creating new rich content");
                response = await fetch(`/admin/api/richContents`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        "X-CSRF-Token": document.head.querySelector("[name~=csrf-token][content]").content,
                    },
                    body: JSON.stringify({id, html: '', css: '', js: '', project_data: JSON.stringify({})}),
                });
                if (!response.ok) {
                    alert('Error creating new rich content');
                    return;
                }
            }
            const data = await response.json();

            var editor = grapesjs.init({
                height: "100vh",
                container : '#gjs',
                storageManager: {
                    type: 'local', // Storage type. Available: local | remote
                    autosave: false, // Store data automatically
                    autoload: false, // Autoload stored data on init
                },
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
            editor.loadProjectData(JSON.parse(data.data.project_data));

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

                    fetch("/admin/api/richContents/" + id, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            "X-CSRF-Token": csrfToken,
                        },
                        body: JSON.stringify({id, html, css, js, project_data: JSON.stringify(editor.getProjectData())}),
                    }).then(data => data.json()).then(data => {
                        console.log(data);
                        const query = new URLSearchParams();
                        query.set(queryParam, id);
                        window.location.href = ("{{ url()->previous() }}?" + query.toString());
                    }).catch(err => {
                        console.log(err);
                        alert('Save failed')
                    });
                },
                attributes: {
                    title: 'Save Template'
                },
            })
        }); // end of event listener
    </script>
  </body>
</html>
