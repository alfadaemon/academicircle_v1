<?php
App::import('Vendor', 'Humantime', array('file'=>'humantime'.DS.'humantime.php'));
$humantime = new humantime();

foreach($Post as $post){
?>
<div class="thread">
<?php
    echo '<a>'.$post['User']['fname'].' '.$post['User']['flname'].'</a> says: '.$post['Post']['message'].'<br />';
    foreach($post['Comment'] as $comment){
?>
    <div class="comment">
<?php
        echo $comment['User']['fname'].' commented '.$humantime->getHumanTime(strtotime($comment['posttime'])).': '.$comment['content'];
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
    echo $form->input('Comment.content', array('value'=>'', 'label'=>false, 'type'=>'textarea', 'rows'=>2));
    echo $form->hidden('Comment.post_id', array('value'=>$post['Post']['id']));
    echo $form->submit(__d('logged','comment',true), array('id'=>'post'.$rnumber));
    echo $ajax->button('post'.$rnumber, array('icons'=>array('secondary'=>'ui-icon-circle-close')));
    echo $form->End();
    echo $ajax->divEnd('postComment'.$rnumber);

    echo $ajax->divEnd('randomDiv'.$rnumber);
?>
</div>
    <?php
}
?>
