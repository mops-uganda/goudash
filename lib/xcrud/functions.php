<?php
function publish_action($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE subprogrammes SET `Priority` = 1 WHERE id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}

function add_fav_report($xcrud)
{
    if ($xcrud->get('primary')) {
        $db = Xcrud_db::get_instance();
        $query = 'INSERT INTO `reports_favourite` (`username`, `report_name`, `report_category`, `link`, `report_id`) VALUES ("' . $xcrud->get('username') . '", "' . $xcrud->get('report_name') . '", "' . $xcrud->get('report_category') . '", "' . $xcrud->get('link') . '", "' . (int)$xcrud->get('primary') . '")';
        $db->query($query);
    }
}

function add_user_icon($value, $fieldname, $primary_key, $row, $xcrud)
{
    return '<div class="alert alert-success fade in"> ' . $value . '  <strong class="pull-right"><i class="fa fa-slack"></i> ' . $row['actions_tracker.current_status'] . '</strong></div>';
}

function unpublish_action($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE subprogrammes SET `Priority` = 0 WHERE id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}

function checkuploaded($postdata){
    if ($postdata->get('imagefile') == ""){
        $postdata->set('imagefile', 'footer.png');
    }
}

function up_KO_action($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE keyoutputs_perf SET `Priority` = 1 WHERE ID = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}

function up_KPI_action($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE kpisperf SET `Priority` = 1 WHERE ID = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}

function KPI_Achieved_action($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $Quarter = 'Q1';
        list($Quarter, $Status, $Primary) = explode('::', $xcrud->get('primary'));
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE kpisperf SET `' . $Quarter . '_Scorecard` = "' . $Status . '" WHERE ID = ' . (int)$Primary;
        $db->query($query);
    }
}

function KO_Achieved_action($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $Quarter = 'Q1';
        list($Quarter, $Status, $Primary) = explode('::', $xcrud->get('primary'));
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE keyoutputs_perf SET `' . $Quarter . '_Scorecard` = "' . $Status . '" WHERE ID = ' . (int)$Primary;
        $db->query($query);
    }
}

function down_KO_action($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE keyoutputs_perf SET `Priority` = 0 WHERE ID = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}

function down_KPI_action($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE kpisperf SET `Priority` = 0 WHERE ID = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}

function exception_example($postdata, $primary, $xcrud)
{
    // get random field from $postdata
    $postdata_prepared = array_keys($postdata->to_array());
    shuffle($postdata_prepared);
    $random_field = array_shift($postdata_prepared);
    // set error message
    $xcrud->set_exception($random_field, 'This is a test error', 'error');
}

function test_column_callback($value, $fieldname, $primary, $row, $xcrud)
{
    return $value . ' - nice!';
}

function after_upload_example($field, $file_name, $file_path, $params, $xcrud)
{
    $ext = trim(strtolower(strrchr($file_name, '.')), '.');
    if ($ext != 'pdf' && $field == 'uploads.simple_upload')
    {
        unlink($file_path);
        $xcrud->set_exception('simple_upload', 'This is not PDF', 'error');
    }
}

function movetop($xcrud)
{
    if ($xcrud->get('primary') !== false)
    {
        $primary = (int)$xcrud->get('primary');
        $myvote = $xcrud->get('vote');
        $db = Xcrud_db::get_instance();
        $query = 'SELECT `id` FROM `vote_departments` WHERE vote = "' . $myvote . '" ORDER BY `ordering`,`id`';
        $db->query($query);
        $result = $db->result();
        $count = count($result);

        $sort = array();
        foreach ($result as $key => $item)
        {
            if ($item['id'] == $primary && $key != 0)
            {
                array_splice($result, $key - 1, 0, array($item));
                unset($result[$key + 1]);
                break;
            }
        }

        foreach ($result as $key => $item)
        {
            $query = 'UPDATE `vote_departments` SET `ordering` = ' . $key . ' WHERE id = ' . $item['id'];
            $db->query($query);
        }
    }
}
function movebottom($xcrud)
{
    if ($xcrud->get('primary') !== false)
    {
        $primary = (int)$xcrud->get('primary');
        $myvote = $xcrud->get('vote');
        $db = Xcrud_db::get_instance();
        $query = 'SELECT `id` FROM `vote_departments` WHERE vote = "' . $myvote . '" ORDER BY `ordering`,`id`';
        $db->query($query);
        $result = $db->result();
        $count = count($result);

        $sort = array();
        foreach ($result as $key => $item)
        {
            if ($item['id'] == $primary && $key != $count - 1)
            {
                unset($result[$key]);
                array_splice($result, $key + 1, 0, array($item));
                break;
            }
        }

        foreach ($result as $key => $item)
        {
            $query = 'UPDATE `vote_departments` SET `ordering` = ' . $key . ' WHERE id = ' . $item['id'];
            $db->query($query);
        }
    }
}

function show_description($value, $fieldname, $primary_key, $row, $xcrud)
{
    $result = '';
    if ($value == '1')
    {
        $result = '<i class="fa fa-check" />' . 'OK';
    }
    elseif ($value == '2')
    {
        $result = '<i class="fa fa-circle-o" />' . 'Pending';
    }
    return $result;
}

function checkData($postdata){
    $postdata['infofeed.imagefile'] = 'footerx.png';
    //$postdata->set('my_field', mb_strtoupper($postdata->get('my_field')));
    return $postdata;
}

function custom_field($value, $fieldname, $primary_key, $row, $xcrud)
{
    return '<input type="text" readonly class="xcrud-input" name="' . $xcrud->fieldname_encode($fieldname) . '" value="' . $value .
        '" />';
}
function unset_val($postdata)
{
    $postdata->del('Paid');
}

function format_phone($new_phone)
{
    $new_phone = preg_replace("/[^0-9]/", "", $new_phone);

    if (strlen($new_phone) == 7)
        return preg_replace("/([0-9]{3})([0-9]{4})/", "$1-$2", $new_phone);
    elseif (strlen($new_phone) == 10)
        return preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "($1) $2-$3", $new_phone);
    else
        return $new_phone;
}

function before_list_example($list, $xcrud)
{
    var_dump($list);
}

function after_update_test($pd, $pm, $xc)
{
    $xc->search = 0;
}

function after_upload_test($field, &$filename, $file_path, $upload_config)
{
    $filename = 'bla-bla-bla';
}
