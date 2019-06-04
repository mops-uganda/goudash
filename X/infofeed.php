<?php
require_once '../securex/extra/auth.php';
$returnURL = 'X/infofeed';
if (! Auth::check()) {
    redirectTo('securex/public/login?to=' . $returnURL);
    exit();
}
app(\Vanguard\Services\Logging\UserActivity\Logger::class)->log($returnURL);

require ('../lib/xcrud/xcrud.php');

date_default_timezone_set('Africa/Kampala');
$date = date('m/d/Y h:i:s a', time());

$user = Auth::user();

$tasks = Xcrud::get_instance();
$tasks->table('infofeed')
        ->order_by('feedID','desc')
        ->table_name('Announcements and Information Feed')
        ->columns('display')
        ->label(array('display'=>'Information Feed'))
        ->fields('Title,message_type,Description,imagefile,Post_Time')
        ->pass_var('Names', $user->first_name . " " . $user->last_name)
        ->pass_default('Post_Time', $date)
        ->pass_default('imagefile', "footer.png")
        ->pass_var('Created_By', $user->username)
        ->pass_var('avatar', $user->avatar)
        ->search_columns('message_type,Post_Time,Names,Description', 'Title')
        ->column_pattern('display', '<div class="panel-body status"><div class="who clearfix"><img alt="img" class="online" src="./securex/public/upload/users/{avatar}"><span class="name"><b>{Names}</b> sent {message_type}</span><span class="from"><b>at {Post_Time}</b> via Info Feed</span></div><div class="text"><h5>{Title}</h5>{Description}<br><img class="imgfooterx" src="lib/uploads/gallery/{imagefile}" ></div> <ul class="links"><li><a><i class="fa fa-comment"></i> Reply</a></li><li><a><i class="fa fa-thumbs-o-up"></i> Like</a></li></ul></div>')
        ->change_type('imagefile', 'image', false, array(
            'width' => 450,
            'path' => '../uploads/gallery',
            'thumbs' => array(array(
                'height' => 55,
                'width' => 120,
                'crop' => true,
                'marker' => '_th'))));
$tasks->before_insert('checkuploaded');
$tasks->unset_edit()
        ->unset_remove()
        ->unset_view()
        ->unset_limitlist()
        ->unset_csv()
        ->set_lang('add','Add New Announcement or Information Feed');

echo $tasks->render();