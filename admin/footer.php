<div style="clear: both;"></div>

   
<p></p>

<div style="width: 100%">

    <div style="clear: both;"></div>
  <div style="width: 100%">

    <div style="clear: both;"></div>

</div>
    <p style="clear: both;"></p>
</div>

<?php 
$action = (isset($_GET['action']) ? $_GET['action'] : null);
$page = (isset($_GET['page']) ? $_GET['page'] : null);

if ($page == "hatchbuck-manage" && ($action == "snippet-add" || $action == "snippet-edit") ){
?>
<script>
    //setting basePath fixes compatability issue with mod_pagespeed minification   
    ace.config.set("basePath", "<?php echo plugin_dir_url( HATCHBUCK_PLUGIN_FILE ) . 'js/ace'; ?>");
    var editor = ace.edit("ace-editor");
    editor.setOption("showPrintMargin", false);
    var textarea = jQuery('textarea[name="snippetContent"]').hide();
    editor.getSession().setValue(textarea.val());
    editor.getSession().on('change', function(){
        textarea.val(editor.getSession().getValue());
    });
    editor.session.setMode("ace/mode/html");
    editor.setTheme("ace/theme/chrome");
    
    var session = editor.getSession();
    session.on("changeAnnotation", function() {
    var annotations = session.getAnnotations()||[], i = len = annotations.length;
    while (i--) {
    if(/doctype first\. Expected/.test(annotations[i].text)) {
      annotations.splice(i, 1);
    }
    }
    if(len>annotations.length) {
    session.setAnnotations(annotations);
    }
    });
</script>
<?php } ?>