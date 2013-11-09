<script language = "Javascript">
/**
 * DHTML textbox character counter script. Courtesy of SmartWebby.com (http://www.smartwebby.com/dhtml/)
 */

maxL=255;
var bName = navigator.appName;
function taLimit(taObj) {
	if (taObj.value.length==maxL) return false;
	return true;
}

function taCount(taObj,Cnt) {
	objCnt=createObject(Cnt);
	objVal=taObj.value;
	if (objVal.length>maxL) objVal=objVal.substring(0,maxL);
	if (objCnt) {
		if(bName == "Netscape"){
			objCnt.textContent=maxL-objVal.length;}
		else{objCnt.innerText=maxL-objVal.length;}
	}
	return true;
}
function createObject(objId) {
	if (document.getElementById) return document.getElementById(objId);
	else if (document.layers) return eval("document." + objId);
	else if (document.all) return eval("document.all." + objId);
	else return eval("document." + objId);
}
</script>
<?php
echo $session->flash('auth');
echo $session->flash();

App::import('Vendor', 'Humantime', array('file'=>'humantime'.DS.'humantime.php'));
$humantime = new humantime();

echo $ajax->div('workArea', array('class'=>'workarea', 'style'=>'margin: auto 10%; min-height:300px; display:block; clear:both;'));
?>

<div id="editArea" >
<div id="postthread">
<?php
    if(!isset($redirect)){
        echo $ajax->form(array('type'=>'post','options'=>array('update'=>'postthread', 'indicator' => 'LoadingDiv', 'after'=>"$('#postthread').show('slow')", 'style'=>'float:left',  'url'=>array('controller'=>'Posts', 'action'=>'add'))));
        //echo $form->input('message', array('label'=>false, 'type'=>'textarea', 'rows'=>2, 'div'=>array('class'=>'input required'),'name'=>'data[Post][message]'));
?>
<font style="font-size:10px;"><?php echo __d('logged','uhave', true); ?> <B><SPAN id=myCounter>255</SPAN></B> <?php echo __d('logged','charsremaining', true); ?>...</font>
<br>
<textarea id="message" name="data[Post][message]" onKeyPress="return taLimit(this)" onKeyUp="return taCount(this,'myCounter')" name="Description" rows=7 wrap="physical" cols=40>
</textarea>
<?php
        echo $form->input('Post.mylist_id', array('label'=>false, 'options'=>$mylists) );
        echo $form->End(__d('logged','post',true));
    }
?>
</div>
<?php
foreach($posts as $post){
?>
<div style="clear:both;">
<div class="thread" style="clear:both;">
<?php
    //echo '<span>'.print_r($post).'<span />';
    $rnumber0 = rand();

    echo $ajax->link(__d('logged', 'view', true).' '.__d('logged', 'membersinlist', true), array('controller'=>'list_members', 'action'=>'inlist', $post['Post']['mylist_id']),
                    array('style'=>'float:right; position:relative;',
                        'title'=>__d('logged', 'view', true).' '.__d('logged', 'membersinlist', true),
                        'before'=>"$('#viewright".$rnumber0."').fadeToggle('slow', 'swing')",
                        'update' => "viewright".$rnumber0,
                        'indicator'=>'LoadingDiv',
                        'id'=>'right'.$rnumber0,
                        'escape'=>false)
        );
    echo $ajax->button('right'.$rnumber0, array('icons'=>array('primary'=>'ui-icon-person'), 'text'=>false) );

    echo '<a>'.$post['User']['fname'].' '.$post['User']['flname'].'</a>: '.$post['Post']['message'].'<p> -'.$humantime->getHumanTime(strtotime($post['Post']['postdate']) ).'-</p>';
    foreach($post['Comment'] as $comment){
?>
    <div class="comment">
<?php
        echo '<p><a>'.$comment['User']['fname'].' '.$comment['User']['flname'].'</a> commented '.$humantime->getHumanTime(strtotime($comment['posttime'])).': </p>'.$comment['content'];
?>
    </div>
<?php
    }
    $rnumber = rand();
    echo $ajax->div('randomDiv'.$rnumber);
    $title=__d('logged','add',true).' '.__d('logged', 'comment', true);
    echo $ajax->link($title, '#', array('title'=>$title, 'before'=>"$('#postComment".$rnumber."').fadeToggle()", 'indicator'=>'LoadingDiv', 'id'=>'linkComment'.$rnumber, 'escape'=>false));
    echo $ajax->button('linkComment'.$rnumber, array('icons'=>array('primary'=>'ui-icon-comment'), 'text'=>false) );

    echo $ajax->div('postComment'.$rnumber, array('style'=>'display:none'));
    echo $ajax->form(array('type'=>'post', 'options'=>
					array('url'=>array('controller'=>'comments', 'action'=>'add'),
					'Model'=>'Comment', 
					'update'=>'randomDiv'.$rnumber,
					'indicator' => 'LoadingDiv')
			 ));//, 'style'=>'float:left'));
    //echo $form->input('Comment.content', array('value'=>'', 'label'=>false, 'type'=>'textarea', 'rows'=>2));
    ?>
    <font style="font-size:10px;"><?php echo __d('logged','uhave', true); ?> <B><SPAN id=myCounter<?php echo $rnumber;?>>255</SPAN></B> <?php echo __d('logged','charsremaining', true); ?>...</font>
    <br>
    <textarea id="content" name="data[Comment][content]" onKeyPress="return taLimit(this)" onKeyUp="return taCount(this,'myCounter<?php echo $rnumber;?>')" name="Content" rows=7 wrap="physical" cols=30></textarea>
    <?
    echo $form->hidden('Comment.post_id', array('value'=>$post['Post']['id']));
    echo $form->submit(__d('logged','comment',true), array('id'=>'post'.$rnumber));
    echo $ajax->button('post'.$rnumber, array('icons'=>array('secondary'=>'ui-icon-circle-close')));
    echo $form->End();
    echo $ajax->divEnd('postComment'.$rnumber);

    echo $ajax->divEnd('randomDiv'.$rnumber);
?>
</div>
    <?php
        echo $ajax->div('viewright'.$rnumber0, array('style'=>'display:none; background:#FFF; font-size:9px; color:#535353; margin-top:10px;float:left; position:relative; overflow: auto; border: 1px solid #F3F3F3; max-height: 120px; min-width: 330px;'));
        echo $ajax->divEnd('viewright'.$rnumber0);
    ?>
</div>
    <?php
}
?>
</div>
<?php
echo $ajax->divEnd('workArea');
?>
