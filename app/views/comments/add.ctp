<div class="comment">
<?php
    if(isset($comment))
        echo '<a>'.$comment['User']['fname'].' '.$comment['User']['flname'].'</a> just commented  : '.$comment['Comment']['content'];
?>
</div>
<?php
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
    echo $form->hidden('Comment.post_id', array('value'=>$comment['Comment']['post_id']));
    echo $form->submit(__d('logged','comment',true), array('id'=>'post'.$rnumber));
    echo $ajax->button('post'.$rnumber, array('icons'=>array('secondary'=>'ui-icon-circle-close')));
    echo $form->End();
    echo $ajax->divEnd('postComment'.$rnumber);

    echo $ajax->divEnd('randomDiv'.$rnumber);
?>
