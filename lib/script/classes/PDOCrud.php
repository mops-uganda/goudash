<?php
/**
 * PDOCrud - Advance PHP CRUD application using PDO
 * File: PDOCrud.php
 * Author: Pritesh Gupta
 * Version: 4.2.1
 * Release Date: 21-Aug-2016
 * Last Update : 01-jun-2019
 *
 * Copyright (c) 2019 Pritesh Gupta. All Rights Reserved.

  /* ABOUT THIS FILE:
  ---------------------------------------------------------------------------------------------------------------
  PDOCrud is an advance PHP based CRUD(Create, Read, Update and Delete) application. It supports Mysql, Pgsql and Sqlite database.
  By writing just 2-3 lines of code only, you can perform insert/update/delete and select operation. You just to need to create object  and call for render function for that table and everything will be generated automatically. It supports all types of database fields.
  Fields will be generated based on the data type. You can remove fields, change type of fields and can do various types of customization.

  ---------------------------------------------------------------------------------------------------------------
 */
Class PDOCrud {

    private $tableName;
    private $multi;
    private $form;
    private $formSteps;
    private $formExport;
    private $formCaptcha;
    private $formEmail;
    private $formPopup;
    private $formId;
    private $fieldValidation;
    private $fields;
    private $fieldAttr;
    private $fieldsStatic;
    private $fieldsRemove;
    private $fieldType;
    private $fieldDepend;
    private $fieldNames;
    private $fieldDataBind;
    private $fieldDesc;
    private $fieldAddOn;
    private $fieldBlockClass;
    private $fieldClass;
    private $fieldOrder;
    private $fieldDefaultOrder = 1000;
    private $fieldNotRequired;
    private $formFieldVal;
    private $hideFieldName;
    private $hideButton;
    private $fieldGroup;
    private $tooltip;
    private $crudTooltip;
    private $settings;
    private $currentLang;
    private $pdocrudView;
    private $pdocrudErrCtrl;
    private $pdocrudhelper;
    private $pdoTableFormatObj;
    private $pdocrudvalidate;
    private $objKey;
    private $HTMLContent;
    private $pk;
    private $pkVal;
    private $js;
    private $jsSettings;
    private $colApplyJs;
    private $css;
    private $plugins;
    private $message;
    private $tableFieldJoin = "#$";
    private $callback;
    private $joinTable;
    private $leftJoin;
    private $columns;
    private $currentpage;
    private $orderByCols;
    private $sortOrder;
    private $tableDataFormat;
    private $colFormat;
    private $colTypes;
    private $colDepends;
    private $colAdd;
    private $colSumPerPage;
    private $colSumTotals;
    private $colNames;
    private $colAttr;
    private $colsRemove = array();
    private $actions;
    private $btnActions;
    private $search;
    private $filterData;
    private $searchCols;
    private $directCall;
    private $inlineEdit;
    private $tableHeading;
    private $tableSubHeading;
    private $crudCall;
    private $backOperation = false;
    private $sql;
    private $crudFilter;
    private $crudFilterSource;
    private $recaptcha;
    private $formRedirection;
    private $fieldConditionalLogic;
    private $submitbtnClass;
    private $tableColDatasource;
    private $bulkCrudUpdateCol;
    private $searchOperator;
    private $advSearch;
    private $advSearchDataSource;
    private $advSearchParam;
    private $advSearchData;
    private $imageFlip;
    private $imageText;
    private $watermark;
    private $imageThumbnail;
    private $imageCrop;
    private $imageDimensions;
    private $multiTableRelation;
    private $multiTableRelationDisplay;
    private $chart;
    private $viewColumns;
    private $portfolioCol;
    private $delJoinTableData = true;
    private $triggerOperation;
    private $forgotPass;
    private $searchColDataType;
    private $fieldFormula;
    private $viewColFormat;
    private $sidebar;
    private $exportColName;
    private $btnTopAction;
    private $dateRangeReport;
    private $dateRangeData;
    private $colOrder;
    private $session;
    private $checkDuplicate;
    private $op;
    private $editFields;
    private $searchBoxCols;
    private $chartData;
    private $recordsPerPageList;
    private $relData;
    private $isRelData;

    /*     * ******************* File related variables - use this for various file operations ******************************** */
    public $fileOutputMode = "save"; // if fileOutputMode="browser", then it will ask for download else it will save
    public $checkFileName = true; // If true then it checks for illegal character in file name
    public $checkFileNameCharacters = true; // If true then it checks for no. of character in file name, should be less than 255
    public $replaceOlderFile = false; // If true then it will replace the older file if present at same location
    public $uploadedFileName = ""; // Name of new uploaded file 
    public $fileUploadPath; // Path of the uploaded file
    public $maxSize = 100000; // Max size of file allowed for file upload
    public $fileSavePath; // Default path for saving generated file 
    public $pdfFontName = "helvetica"; // font name for pdf
    public $pdfFontSize = "8"; // font size for pdf
    public $pdfFontWeight = "B"; // font weight for pdf
    public $pdfAuthorName = "Author Name"; // Author name for pdf
    public $pdfSubject = "PDF Subject Name"; // Subject name for pdf	
    public $excelFormat = "2007"; // Set format of excel generate (.xlsx or .xls)
    public $outputXML = ""; // Display xml table generated  
    public $rootElement = "root"; // Root Element for the xml
    public $encoding = "utf-8"; // Encoding for the xml file
    public $rowTagName = ""; // If this is set to some valid xml tag name then generated xml will contain this tagname after each subarray of two dimensional array
    public $append = false; //If true, then will append in the existing file rather than creating a new one(you must set $existingFilePath variable to the location of the existing file)
    public $existingFilePath; // Complete path of existing file including name to use in append operation
    public $delimiter = ","; // Delimiter to be used in handling csv files, default is ','
    public $enclosure = '"'; // Enclosure to be used in handling csv files, default is '"' 
    public $isFile = false; // Whether the supplied xml or html source is file or not
    public $useFirstRowAsTag = false;
    public $outputHTML = ""; // Display html table generated  
    public $tableCssClass = "tblCss"; // css class for the html table
    public $trCssClass = "trCss"; // css class for the html table row (tr)   
    public $htmlTableStyle = ""; // css style for the html table
    public $htmlTRStyle = ""; // css style for the html table row (tr)
    public $htmlTDStyle = ""; // css style for the html table col (td)

    /**
     * Constructor 
     * @param   string   $multi              If multiple instance of form used on the same page, then set this true to avoid loading multiple js/css
     * @param   string   $template           Set template directly
     * @param   string   $skin               Set skin/template directly
     * @param   array    $settings           Set default setting at the time of initialization
     */

    public function __construct($multi = false, $template = "", $skin = "", $settings = array()) {
        $this->initializeSettings();
        $this->loadLangData();
        $this->objKey = $this->getRandomKey();
        $this->pdocrudView = new PDOCrudView();
        $this->pdocrudErrCtrl = new PDOCrudErrorCtrl();
        $this->pdocrudhelper = new PDOCrudHelper($this->pdocrudErrCtrl);
        $this->pdoTableFormatObj = new PDOCrudTableFormat($this->pdocrudErrCtrl);
        $this->multi = $multi;
        if(!$this->pdocrudhelper->verifyPurchaseCode($this->settings)){
            die();
        }
        if (!empty($template))
            $this->settings["template"] = $template;
        if (!empty($skin))
            $this->settings["skin"] = $skin;
        if(isset($settings) && count($settings))
            $this->settings = array_merge($this->settings, $settings);
        if (!$multi) {
            $this->initializeJsSettings();
            $this->registerJs();
            $this->registerCss();
            $this->initializeHTMLContent();
            $this->initializePlugins();
        }
    }

    /**
     * Initialize Settings when object of class created, from the config.php settings
     */
    private function initializeSettings() {
        global $config;
        $this->settings = $config;
        $this->fileUploadPath = $this->settings["uploadFolder"];
        $this->fileSavePath = $this->settings["downloadFolder"];
        $this->currentLang = $this->settings["lang"];
        $this->currentpage = 1;
    }

    private function initializeBtnActions() {
        if ($this->settings["actionbtn"]) {
            if ($this->settings["viewbtn"]) {
                $this->enqueueBtnActions("view", "javascript:;", "view", "<i class=\"fa fa-info-circle\"></i>", "", array("title" => $this->langData["view"]), "btn-info");
            }
            if ($this->settings["editbtn"]) {
                $this->enqueueBtnActions("edit", "javascript:;", "edit", "<i class=\"fa fa-pencil-square-o\"></i>", "", array("title" => $this->langData["edit"]),"btn-warning");
            }
            if ($this->settings["inlineEditbtn"]) {
                $this->enqueueBtnActions("inline_edit", "javascript:;", "inline_edit", "<i class=\"fa fa-pencil\"></i>", "", array("title" => $this->langData["inline_edit"]),"btn-warning");
            }
            if ($this->settings["delbtn"]) {
                $this->enqueueBtnActions("delete", "javascript:;", "delete", "<i class=\"fa fa-times fa-fw\"></i>", "", array("title" => $this->langData["delete"]),"btn-danger");
            }
            if (isset($this->settings["clonebtn"]) && $this->settings["clonebtn"]) {
                $title = isset($this->langData["clone"]) ? $this->langData["clone"] : "sffd";
                $this->enqueueBtnActions("clone", "javascript:;", "clone", "<i class=\"fa fa-clone\"></i>", "", array("title" => $title),"btn-warning");
            }
        }
    }

    /**
     * Get particular configuaration setting
     * @param    string   $setting              Config Key for which setting needs to be retreived 
     * return    mixed                          Configuaration setting value
     */
    public function getSettings($setting) {
        if (isset($this->settings[$setting]))
            return $this->settings[$setting];
        else
            return $this->getLangData("no_settings_found");
    }

    /**
     * Get search data
     * return    array                          get search data
     */
    public function getSearchData() {
        return $this->search;
    }

    /**
     * Set particular configuaration setting
     * @param   string   $setting                   Config key for setting
     * @param   mixed    $value                     Value for setting
     * return   object                              Object of class
     */
    public function setSettings($setting, $value) {
        $this->settings[$setting] = $value;
        return $this;
    }

    /**
     * Set table name for which form needs to be generated
     * @param   string   $tableName                      The name of the table to generate form.
     * return   object                                   Object of class
     */
    public function dbTable($tableName) {
        $this->tableName = $tableName;
        return $this;
    }

    /**
     * Add join between tables, supported join condition are "INNER JOIN" & "LEFT JOIN"
     * @param   string  $joinTableName                             name of table to be joined
     * @param   string  $joinCondition                             join condition e.g. 
     * @param   string  $joinType                                  type of join (Inner or left join)-default is inner join
     * return   object                                             Object of class
     */
    public function joinTable($joinTableName, $joinCondition, $joinType = "INNER JOIN") {
        $this->joinTable[] = array(
            "table" => $joinTableName,
            "condition" => $joinCondition,
            "type" => $joinType
        );
        return $this;
    }

    /**
     * Set html curd table display columns
     * @param   string   $columns                        Columns names to be displayed in table format
     * return   object                                   Object of class
     */
    public function crudTableCol($columns) {
        $this->columns = $columns;
        return $this;
    }

    /**
     * Hide a specific crud table columns
     * @param   string   $columns                        Columns names to be displayed in table format
     * return   object                                   Object of class
     */
    public function crudRemoveCol($columns) {
        $this->colsRemove = $columns;
        return $this;
    }

    /**
     * Add a custom action button in crud
     * @param   string   $actionName                     name of action
     * @param   string   $colName                        column name to be action applied
     * @param   array   $displayVal                      display value of button based on the column value
     * @param   array   $applyVal                        On click, apply value to the column
     * return   object                                   Object of class
     */
    public function crudAddAction($actionName, $colName, $displayVal = array(), $applyVal = array()) {
        $this->curdAddActionBtn[$colName] = array("actionName" => $actionName, "displayVal" => $displayVal, "applyVal" => $applyVal);
        return $this;
    }

    /**
     * Set how many records per page to be displayed in html table
     * @param   int   $val                        no. of records per page e.g. 10
     * return   object                            Object of class
     */
    public function recordsPerPage($val) {
        if (!empty($val)) {
            $this->settings["recordsPerPage"] = $val;
        }
        return $this;
    }
    
    /**
     * Set drop down list of records per page
     * @param   array   $val                      list of records per page e.g 10,25,50,100
     * return   object                            Object of class
     */
    public function setRecordsPerPageList($val) {
        if (!empty($val)) {
            $this->recordsPerPageList = $val;
        }
        return $this;
    }

    /**
     * Sets current page in pagination
     * @param   int   $pageNo                     page no. e.g. 2
     * return   object                            Object of class
     */
    public function currentPage($pageNo) {
        $this->currentpage = $pageNo;
        return $this;
    }

    /**
     * Sets column type in the crud table
     * @param   string   $colName                     column name to be changed
     * @param   string   $colType                     type of column to be set
     * @param   string   $parameters                  column parameters
     * return   object                                Object of class
     */
    public function colTypes($colName, $colType, $parameters = "") {
        $this->colTypes[$colName] = array(
            "type" => $colType,
            "parameters" => $parameters
        );
        return $this;
    }

    /**
     * Tooltip for the column
     * @param   string   $colName                                Name of columns for which tooltip needs to be added
     * @param   string   $tooltip                                Tooltip to be shown
     * @param   string   $tooltipIcon                            Icon for the tooltip
     * return   object                                           Object of class
     */
    public function crudColTooltip($colName, $tooltip, $tooltipIcon = "<i class='glyphicon glyphicon-info-sign'></i>") {
        $this->crudTooltip[$colName] = array(
            "tooltip" => $tooltip,
            "tooltipIcon" => $tooltipIcon
        );
        return $this;
    }

    /**
     * Sets primary key
     * @param   string   $columnName              sets primary key
     * return   object                            Object of class
     */
    public function setPK($columnName) {
        $this->pk = $columnName;
        return $this;
    }

    /**
     * Set whether current operation is inline edit or not
     * @param   string   $setting                   Config key for setting
     * @param   mixed    $value                     Value for setting
     * return   object                              Object of class
     */
    public function setInlineEdit($val = false) {
        $this->inlineEdit = $val;
        return $this;
    }

    /**
     * Sets order by condition for crud html table data
     * @param   mixed   $orderbyCols             columns names for which data needs to be order by
     * return   object                            Object of class
     */
    public function dbOrderBy($orderbyCols) {
        if (is_array($orderbyCols))
            $this->orderByCols = implode($orderbyCols, ",");
        else
            $this->orderByCols = $orderbyCols;
        return $this;
    }

    /**
     * Sets limit of records to be displayed
     * @param   int   $limit                        limit of records to be used
     * return   object                              Object of class
     */
    public function dbLimit($limit) {
        $this->limit = $limit;
        return $this;
    }

    /**
     * Sets search columns 
     * @param   array   $cols                       Set columns to be used for search
     * return   object                              Object of class
     */
    public function setSearchCols($cols) {
        $this->searchCols = $cols;
        $this->searchBoxCols = $cols;
        return $this;
    }

    /**
     * Set form related parameters e.g.  formHeading, formType="horizontal/inline", form class and attribute etc.
     * @param   string   $formHeading                     Heading of form (fieldset)  
     * @param   string   $formType                        Type of form (normal, horizontal or inline) for bootstrap
     * @param   array    $class                           CSS Class for form
     * @param   array    $attr                            Various data attributes for form 
     * return   object                                    Object of class
     */
    public function formTag($formHeading = "", $formType = "", $class = array(), $attr = array()) {
        $this->form = array(
            "formHeading" => $formHeading,
            "formType" => $formType,
            "class" => $class,
            "attr" => $attr
        );
        return $this;
    }

    /**
     * Set which fields of table to be displayed in form
     * @param   array   $fields                           Form fields to displayed only
     * return   object                                    Object of class
     */
    public function formFields($fields) {
        $this->fields = $fields;
        return $this;
    }
    
    /**
     * Set which fields of table to be displayed in edit form
     * @param   array   $fields                           Form fields to displayed only
     * return   object                                    Object of class
     */
    public function editFormFields($fields) {
        $this->editFields = $fields;
        return $this;
    }

    /**
     * Removes specific fields from form
     * @param   array   $fields                           Fields to removed from form
     * return   object                                    Object of class
     */
    public function formRemoveFields($fields = array()) {
        $this->fieldsRemove = $fields;
        return $this;
    }

    /**
     * Set email related settings if form sends email instead of insert/update operation
     * @param   string   $from                          From email
     * @param   string   $to                            To email
     * @param   string   $subject                       Subject of email
     * @param   string   $message                       Message of the email
     * return   object                                  Object of class
     */
    public function formSendEmail($from, $to, $subject, $message, $saveDb = false) {
        $this->formEmail = array(
            "from" => $from,
            "to" => $to,
            "subject" => $subject,
            "message" => $message,
            "save_db" => $saveDb
        );
        return $this;
    }

    /**
     * Set primary key and value for update form
     * @param   string   $pk                             Set primary key field name
     * @param   string   $pkval                          Set primary key value for which data needs to be retreived
     * return   object                                  Object of class
     */
    public function formSetPrimarykey($pk, $pkval) {
        $this->pk = $pk;
        $this->pkVal = $pkval;
        return $this;
    }
    
    /**
     * Set primary key and value for update form
     * @param   string   $pkval                          Set primary key value for which data needs to be retreived
     * return   object                                  Object of class
     */
    public function setPrimarykeyValue($pkval) {
        $this->pkVal = $pkval;
        return $this;
    }

    /**
     * Export related settings, instead of inserting data in database, you can directly export it to PDF, CSV, Excel and XML
     * @param   string   $exportType                    Whether to export in pdf, csv, excel or xml
     * return   object                                  Object of class
     */
    public function formExportData($exportType = "pdf") {
        $this->formExport = $exportType;
        return $this;
    }

    /**
     * Add captcha in form
     * @param   string   $fieldName                     Name of field for captcha
     * return   object                                  Object of class
     */
    public function formAddCaptcha($fieldName) {
        $this->formCaptcha[$fieldName] = array(
            "Field" => $fieldName,
            "Type" => "captcha",
            "Null" => "NO",
            "Key" => "",
            "Default" => "",
            "Extra" => "captcha"
        );
        return $this;
    }

    /**
     * Display form in popup on click on some button
     * @param   string   $buttonContent                     Text for the button 
     * @param   string   $headerContent                     Header text for the popup
     * @param   string   $directCall                        Set this true to use it for form directly
     * return   object                                      Object of class
     */
    public function formDisplayInPopup($buttonContent = "", $headerContent = "", $directCall = false) {
        $this->formPopup = array(
            "buttonContent" => $buttonContent,
            "headerContent" => $headerContent
        );
        $this->directCall = $directCall;
        return $this;
    }

    /**
     * Sets ID of Form
     * @param   string   $id                                ID of the form
     * return   object                                      Object of class
     */
    public function formId($id) {
        $this->formId = $id;
        return $this;
    }

    /**
     * Change display order of the fields
     * @param   array   $fields                             fields in ascending order to be displayed in form
     * return   object                                      Object of class
     */
    public function fieldDisplayOrder($fields) {
        $this->fieldOrder = $fields;
        return $this;
    }

    /**
     * Set field formula to change the value of field dynamically during insert/update operation
     * @param   string   $field                              Field to be modified  
     * @param   string   $formatType                         Type of formula, e.g. string or formula(math forumula)
     * @param   array    $paramaters                         parameters to be used for formula
     * return   object                                       Object of class
     */
    public function fieldFormula($field, $formatType, $paramaters) {
        $this->fieldFormula[$field] = array(
            "formatType" => $formatType,
            "paramaters" => $paramaters
        );
        return $this;
    }

    /**
     * Set specific css class to the different fields
     * @param   string  $fieldName                             field name for which css class name needs to be applied
     * @param   array   $fieldClass                         css class name for the field
     * return   object                                         Object of class
     */
    public function fieldCssClass($fieldName, $fieldClass = array()) {
        $this->fieldClass[$fieldName] = $fieldClass;
        return $this;
    }

    /**
     * Add static fields to the form
     * @param   string  $fieldName                             name of static field
     * @param   string  $fieldType                             type of field, e.g. radio, checkbox etc
     * @param   string  $fieldValue                            Value of the field
     * @param   string  $extra                                 Whether it is static field or database field
     * return   object                                         Object of class
     */
    public function formStaticFields($fieldName, $fieldType, $fieldValue = "", $extra = "static", $dbField = "") {
        $this->fieldsStatic[$fieldName] = array(
            "Field" => $fieldName,
            "Type" => $fieldType,
            "Null" => "NO",
            "Key" => "",
            "Default" => "",
            "Extra" => $extra,
            "DbField" => $dbField
        );
        $this->fieldDataBinding($fieldName, $fieldValue, "", "", "array");
        return $this;
    }

    /**
     * Rename the field label name
     * @param   string  $fieldName                             field name for which lable name needs to be changed
     * @param   string  $lableName                             lable name to be set
     * return   object                                         Object of class
     */
    public function fieldRenameLable($fieldName, $lableName) {
        $this->fieldNames[$fieldName] = $lableName;
        return $this;
    }

    /**
     * Hide the field label name
     * @param   string  $fieldName                             field name for label needs to be hidden
     * @param   bool    $takeSpace                             whether hidden lable should take space or not
     * return   object                                         Object of class
     */
    public function fieldHideLable($fieldName, $takeSpace = false) {
        $this->hideFieldName[$fieldName] = array(
            "takeSpace" => $takeSpace
        );
        return $this;
    }

    /**
     * Removes required attribute from fields
     * @param   string  $fieldName                             field name for which required attribute needs to be removed
     * return   object                                         Object of class
     */
    public function fieldNotMandatory($fieldName) {
        $this->fieldNotRequired[$fieldName] = true;
        return $this;
    }

    /**
     * Sets the data attribute of field
     * @param   string  $fieldName                             field name for attribute needs to set
     * @param   array   $attr                                  Array of data attributes with key as attribute name and value as attribute value
     * return   object                                         Object of class
     */
    public function fieldAttributes($fieldName, $attr = array()) {
        $this->fieldAttr[$fieldName][] = $attr;
        return $this;
    }

    /**
     * Sets the type of field
     * @param   string  $fieldName                             field name for types needs to be set
     * @param   string  $type                                  Field type 
     * @param   string  $parameters                            Field parameters
     * return   object                                         Object of class
     */
    public function fieldTypes($fieldName, $type, $parameters = "") {
        $this->fieldType[$fieldName] = array(
            "type" => strtoupper($type),
            "parameters" => $parameters
        );
        return $this;
    }

    /**
     * Sets the validation require for the field
     * @param   string  $fieldName                             field name for validation needs to be set
     * @param   string  $validation                            validation like required, email etc
     * @param   string  $param                                 value of validation, default is true
     * @param   string  $errorMsg                              error message to be displayed
     * @param   string  $fieldType                             field type
     * return   object                                         Object of class
     */
    public function fieldValidationType($fieldName, $validation, $param = "true", $errorMsg = "", $fieldType = "table") {
        $validation = str_replace("_", "-", $validation);
        if (empty($errorMsg)) {
            switch ($validation) {
                case "required":
                    $errorMsg = $this->getLangData("req_field");
                    break;
                case "email":
                    $errorMsg = $this->getLangData("invalid_email");
                    break;
                case "url":
                    $errorMsg = $this->getLangData("invalid_url");
                    break;
                case "date":
                    $errorMsg = $this->getLangData("invalid_date");
                    break;
                case "numeric":
                    $errorMsg = $this->getLangData("numeric_only");
                    break;
                case "int":
                    $errorMsg = $this->getLangData("int_only");
                    break;
                case "int":
                    $errorMsg = $this->getLangData("int_only");
                    break;
                case "float":
                    $errorMsg = $this->getLangData("float_only");
                    break;
                case "minlength":
                    $errorMsg = $this->getLangData("min_length");
                    break;
                case "maxlength":
                    $errorMsg = $this->getLangData("max_length");
                    break;
                case "data-match":
                    $errorMsg = $this->getLangData("match");
                    break;
            }
        }

        if (strtolower($fieldType) === "static" && $validation === "data-match")
            $param = "#pdocrud" . $this->encrypt($param);

        $this->fieldValidation[$fieldName][] = array(
            "$validation" => $param,
            "data-error" => $errorMsg,
            "data-pdocrud-validation" => true
        );
        return $this;
    }

    /**
     * Sets the dependent field to be loaded on change of depend on field
     * @param   string  $dependent                             field name to be changed on onchange operation of dependOn field
     * @param   string  $dependOn                              field that change will cause trigger change
     * @param   string  $colName                               name of col, needs to be retrived to change the field value
     * return   object                                         Object of class
     */
    public function fieldDependent($dependent, $dependOn, $colName) {
        $this->fieldDepend[$dependent] = array(
            "dependOn" => $dependOn,
            "colName" => $colName
        );
        return $this;
    }

    /**
     * Sets data binding of the field i.e. load the field data from some datasource
     * @param   string  $fieldName                             field name to be bind
     * @param   mixed   $dataSource                            data source either tablename or array of data
     * @param   string  $key                                   name of col, that will serve as data key
     * @param   mixed   $val                                   name of col as string or array of columns, that will serve as field value
     * @param   string  $bind                                  whether datasource is db table or array or sql, default is db table
     * @param   string  $separator                             Separator string in case of $val is an array of columns. Default value is " "
     * @param   string  $where                                 Where condition for the datasource
     * @param   string  $orderby                               Order by clause for the datasource
     * return   object                                         Object of class
     */
    public function fieldDataBinding($fieldName, $dataSource, $key, $val, $bind = "db", $separator = " ", $where = array(), $orderby = array()) {
        $this->fieldDataBind[$fieldName] = array(
            "tableName" => $dataSource,
            "key" => $key,
            "val" => $val,
            "bind" => $bind,
            "separator" => $separator,
            "where" => $where,
            "orderby" => $orderby
        );
        if ($bind == "array") {
            $dataSource = $this->formatDatasource($dataSource);
            $this->fieldDataBind[$fieldName] = array(
                "dataSource" => $dataSource,
                "bind" => $bind
            );
        }
        if ($bind == "sql") {
            $pdomodelObj = $this->getPDOModelObj();
            $dataSource = $pdomodelObj->executeQuery($dataSource);
            $this->fieldDataBind[$fieldName] = array(
                "dataSource" => $dataSource,
                "bind" => $bind
            );
        }
        return $this;
    }

    /**
     * Sets input addon information for the bootstrap
     * @param   string  $fieldName                             field name for input addon needs to be added
     * @param   string  $position                              position of addon text, whether before or after input it needs to be added
     * @param   string  $addOnText                             add on content that will be added in html format
     * return   object                                         Object of class
     */
    public function fieldAddOnInfo($fieldName, $position, $addOnText) {
        $this->fieldAddOn[$fieldName][$position] = $addOnText;
        return $this;
    }

    /**
     * Sets the class of complete input block inside a bootstrap form-group class
     * @param   string  $fieldName                             field name for which block class needs to be added
     * @param   string  $class                                 class name like col-sm-8 etc.
     * return   object                                         Object of class
     */
    public function fieldBlockClass($fieldName, $class) {
        $this->fieldBlockClass[$fieldName] = $class;
        return $this;
    }

    /**
     * Group fields together like first_name and last_name under Full name group
     * @param   string  $groupName                             Any unuique name of group e.g. full_name
     * @param   array   $fields                                array of fields like array(first_name, last_name)
     * return   object                                         Object of class
     */
    public function fieldGroups($groupName, $fields = array()) {
        $this->fieldGroup[$groupName] = $fields;
        if (is_array($fields) && count($fields) > 0) {
            $colDiv = 12 / count($fields);
            foreach ($fields as $field) {
                $this->fieldBlockClass($field, "col-xs-" . $colDiv);
            }
        }
        return $this;
    }

    /**
     * Divide form fields into various steps/tabs
     * @param   array    $fields                                  Array of fields that will be in same tab
     * @param   string   $stepName                                Name of step(Tab)
     * @param   string   $stepType                                Step type either stepy or tabs 
     * @param   string   $attr                                    Attributes of the step
     * return   object                                            Object of class
     */
    public function FormSteps(array $fields, $stepName, $stepType = "stepy", $attr = array()) {
        $stepId = rand(1, 100) . time();
        $this->formSteps[] = array(
            "stepId" => $stepId,
            "stepName" => $stepName,
            "fields" => $fields,
            "stepType" => $stepType,
            "attr" => $attr
        );
        return $this;
    }

    /**
     * Tooltip for the field
     * @param   string   $fieldName                              Name of field for which tooltip needs to be added
     * @param   string   $tooltip                                Tooltip to be shown
     * @param   string   $tooltipIcon                            Icon for the tooltip
     * return   object                                           Object of class
     */
    public function fieldTooltip($fieldName, $tooltip, $tooltipIcon = "<i class='glyphicon glyphicon-info-sign'></i>") {
        $this->tooltip[$fieldName] = array(
            "tooltip" => $tooltip,
            "tooltipIcon" => $tooltipIcon
        );
        return $this;
    }

    /**
     * Set description of the field
     * @param   string   $fieldName                            Field for which description needs to be set
     * @param   string   $desc                                 Description of the field
     * return   object                                         Object of class
     */
    public function fieldDesc($fieldName, $desc) {
        $this->fieldDesc[$fieldName] = array(
            "desc" => $desc
        );
        return $this;
    }

    /**
     * Set attributes of field
     * @param   string   $colName                            column name for which attribute to be added
     * @param   array    $attr                               attribute to be set
     * return   object                                       Object of class
     */
    public function fieldDataAttr($colName, $attr = array()) {
        $this->fieldAttr[$colName][] = $attr;
        return $this;
    }

    /**
     * Rename a field name
     * @param   string   $fieldName                          field name to renamed
     * @param   string   $newName                            new field name to be used
     * return   object                                       Object of class
     */
    public function fieldRename($fieldName, $newName) {
        $this->fieldNames[$fieldName] = $newName;
        return $this;
    }

    /**
     * Set a value of field
     * @param   string   $fieldName                            field name to renamed
     * @param   string   $value                                value of the field
     * return   object                                         Object of class
     */
    public function formFieldValue($fieldName, $value) {
        $this->formFieldVal[$fieldName] = $value;
        return $this;
    }

    /**
     * Redirects to some other url after form submission
     * @param   string  $redirectionURL                        url to be redirected
     * @param   bool    $reset                                 whether to reset it to empty string when no data present.
     * return   object                                         Object of class
     */
    public function formRedirection($redirectionURL, $reset = false) {
        $this->formRedirection["redirectionURL"] = $redirectionURL;
        $this->formRedirection["reset"] = $reset;
        return $this;
    }

    /**
     * Add conditional logic to the form fields like 
     * @param   string  $fieldname                        field name which trigger event
     * @param   string  $condition                        Conditional logic to be checked
     * @param   string  $op                               Operator to b used
     * @param   string  $field                            field names to be affected
     * @param   string  $task                             Operation(task) to be applied
     * return   object                                    Object of class
     */
    public function fieldConditionalLogic($fieldname, $condition, $op = "=", $field, $task) {
        $this->fieldConditionalLogic[strtolower($fieldname)][] = array("condition" => $condition, "op" => $op, "field" => $field, "task" => $task);
        return $this;
    }

    /**
     * Add field description
     * @param   string   $elementName                        element for which tooltip needs to be added
     * @param   string   $desc                               description of the field
     * @param   string   $type                               type of element whether element or column
     * return   object                                       Object of class
     */
    public function addFieldDesc($elementName, $desc, $type = "field") {
        $this->fieldDesc[$elementName] = array(
            "toolTip" => $toolTip,
            "type" => $type
        );
        return $this;
    }

    /**
     * Hide the cancel button
     * @param   string  $fieldName                             field name for label needs to be hidden
     * @param   bool    $takeSpace                             whether hidden lable should take space or not
     * return   object                                         Object of class
     */
    public function buttonHide($buttonname = "cancel") {
        $this->hideButton[$buttonname] = true;
        return $this;
    }

    /**
     * Set the resize dimension
     * @param   array   $dimensions                     dimensions of image
     * return   object                                  Object of class
     */
    public function resizeImage($dimensions = array()) {
        $this->imageDimensions = $dimensions;
        return $this;
    }

    /**
     * Trim the image and resize to exactly
     * This function attempts to get the image to as close to the provided dimensions as possible, and then crops the
     * remaining overflow (from the center) to get the image to be the size specified. Useful for generating thumbnails.
     *
     * @param int           $width
     * @param int|null      $height If omitted - assumed equal to $width
     * @param string        $focal 
     *
     * return   object      Object of class
     */
    public function thumbnailImage($width, $height = null, $focal = 'center') {
        $this->imageThumbnail = array("width" => $width, "height" => $height, "focal" => $focal);
        return $this;
    }

    /**
     * Crop an image
     *
     * @param int           $x1 Left
     * @param int           $y1 Top
     * @param int           $x2 Right
     * @param int           $y2 Bottom
     *
     * @return SimpleImage
     *
     */
    public function crop($x1, $y1, $x2, $y2) {
        $this->imageCrop = array("x1" => $x1, "y1" => $y1, "x2" => $x2, "y2" => $y2);
        return $this;
    }

    /**
     * Flip an image horizontally or vertically
     *
     * @param string        $direction  x|y
     *
     * @return object       Object of clas
     *
     */
    public function flip($direction) {
        $this->imageFlip = $direction;
        return $this;
    }

    /**
     * Add text to an image
     *
     * @param string        $text
     * @param string        $font_file
     * @param float|int     $font_size
     * @param string|array  $color
     * @param string        $position
     * @param int           $x_offset
     * @param int           $y_offset
     * @param string|array  $stroke_color
     * @param string        $stroke_size
     * @param string        $alignment
     * @param int           $letter_spacing
     *
     * @return object       Object of clas
     *
     */
    function imageText($text, $font_file, $font_size = 12, $color = '#000000', $position = 'center', $x_offset = 0, $y_offset = 0, $stroke_color = null, $stroke_size = null, $alignment = null, $letter_spacing = 0) {
        $this->imageText = array("text" => $text, "font_file" => $font_file, "font_size" => $font_size, "color" => $color, "position" => $position, "x_offset" => $x_offset, "y_offset" => $y_offset, "stroke_color" => $stroke_color, "stroke_size" => $stroke_size, "alignment" => $alignment, "letter_spacing" => $letter_spacing);
        return $this;
    }

    /**
     * Set the overlay image (Watermark)
     * Overlay an image on top of another, works with 24-bit PNG alpha-transparency
     *
     * @param string        $overlay        An image filename or a SimpleImage object
     * @param string        $position       center|top|left|bottom|right|top left|top right|bottom left|bottom right
     * @param float|int     $opacity        Overlay opacity 0-1
     * @param int           $xOffset        Horizontal offset in pixels
     * @param int           $yOffset        Vertical offset in pixels   
     * return object                        Object of class
     */
    public function watermark($overlay, $position = 'center', $opacity = 1, $xOffset = 0, $yOffset = 0) {
        $this->watermark = array("overlay" => $overlay, "position" => $position, "opacity" => $opacity, "xOffset" => $xOffset, "yOffset" => $yOffset);
        return $this;
    }

    /**
     * Set sql 
     * @param   string   $sql                                  Query to be executed
     * return   object                                         Object of class
     */
    public function setQuery($sql) {
        $this->sql = $sql;
        return $this;
    }

    /**
     * Bulk crud table update function to update multiple rows of data simultanously
     * @param   string   $colName                            Column name to be formatted
     * @param   string   $fieldType                          type of field
     * @param   array    $attr                               Attributes of field
     * @param   array    $fieldData                          Data for the field
     * return   object                                       Object of class
     */
    public function bulkCrudUpdate($colName, $fieldType, $attr = array(), $fieldData = array()) {
        $this->bulkCrudUpdateCol[$colName] = array(
            "fieldType" => $fieldType,
            "attr" => $attr,
            "fieldData" => $fieldData
        );
        $this->settings["savebtn"] = true;
        return $this;
    }

    /**
     * Format the particular columns of table
     * @param   string   $colName                            Column name to be formatted
     * @param   string   $formatType                         type of format
     * @param   array    $paramaters                         parameters based on the formatting type
     * return   object                                       Object of class
     */
    public function tableColFormatting($colName, $formatType, $paramaters = array()) {
        $this->colFormat[][$colName] = array(
            "formatType" => $formatType,
            "paramaters" => $paramaters
        );
        return $this;
    }

    /**
     * Format the particular columns of view form
     * @param   string   $colName                            Column name to be formatted
     * @param   string   $formatType                         type of format
     * @param   array    $paramaters                         parameters based on the formatting type
     * return   object                                       Object of class
     */
    public function viewColFormatting($colName, $formatType, $paramaters = array()) {
        $this->viewColFormat[][$colName] = array(
            "formatType" => $formatType,
            "paramaters" => $paramaters
        );
        return $this;
    }

    /**
     * Format the particular entry of column of table
     * @param   string   $applyOn                            Column name to be formatted
     * @param   string   $formatType                         type of format
     * @param   array    $condition                          format condition ot be matched
     * @param   array    $apply                              rules toe be applied
     * return   object                                       Object of class
     */
    public function tableDataFormatting($applyOn, $formatType, $condition = array(), $apply = array()) {
        $this->tableDataFormat[] = array(
            "applyOn" => $applyOn,
            "formatType" => $formatType,
            "condition" => $condition,
            "apply" => $apply
        );
        return $this;
    }

    /**
     * Add a new column to the table
     * @param   string   $colName                            Column name to be added
     * @param   string   $type                               type of column
     * @param   array    $paramaters                         parameters on basis of which column to be added
     * return   object                                       Object of class
     */
    public function tableColAddition($colName, $type, $paramaters = array()) {
        $this->colAdd[$colName] = array(
            "type" => $type,
            "cols" => $paramaters
        );
        return $this;
    }

    /**
     * Change table heading
     * @param   string   $heading                            table heading to be changed
     * return   object                                       Object of class
     */
    public function tableHeading($heading) {
        $this->tableHeading = $heading;
        return $this;
    }

    /**
     * Change table sub heading
     * @param   string   $subHeading                         table sub heading to be changed
     * return   object                                       Object of class
     */
    public function tableSubHeading($subHeading) {
        $this->tableSubHeading = $subHeading;
        return $this;
    }

    /**
     * Set content of crud col based on the value from another table or array of data
     * @param   string   $colname                            crud table column name to be replaced
     * @param   string   $data                               Name of table (if datasource = db) or array to get data
     * @param   string   $joinColName                        Join column name (if datasource = db)
     * @param   string   $dataCol                            Data column name (if datasource = db)
     * @param   string   $dataSource                         dataSource = db or datasource = array
     * return   object                                       Object of class
     */
    public function tableColUsingDatasource($colname, $data, $joinColName, $dataCol, $dataSource = "db") {
        $this->tableColDatasource[] = array("colname" => $colname, "tableName" => $data, "joinColName" => $joinColName, "dataCol" => $dataCol, "dataSource" => $dataSource);
        return $this;
    }

    public function colDependent($dependentCol, $tableName, $dependentOn) {
        $this->colDepends[$dependentCol] = array(
            "tableName" => $tableName,
            "colName" => $dependentOn
        );
        return $this;
    }

    /**
     * Rename a column name
     * @param   string   $colName                            column name to renamed
     * @param   string   $newName                            new column name to be used
     * return   object                                       Object of class
     */
    public function colRename($colName, $newName) {
        $this->colNames[$colName] = $newName;
        return $this;
    }

    /**
     * Set attributes of column
     * @param   string   $colName                            column name for which attribute to be added
     * @param   array   $attr                                attribute to be set
     * return   object                                       Object of class
     */
    public function colDataAttr($colName, $attr = array()) {
        $this->colAttr[$colName] = $attr;
        return $this;
    }

    /**
     * Get sum per page for column
     * @param   string   $colName                            column name for sum to be calculated
     * return   object                                       Object of class
     */
    public function colSumPerPage($colName) {
        $this->colSumPerPage[] = $colName;
    }

    /**
     * Get total sum for column
     * @param   string   $colName                            column name for sum to be calculated
     * return   object                                       Object of class
     */
    public function colSumTotal($colName) {
        $this->colSumTotals[] = $colName;
    }

    /**
     * Set view display columns
     * @param   string   $columns                        Columns names to be displayed in table format
     * return   object                                   Object of class
     */
    public function setViewColumns($columns) {
        $this->viewColumns = $columns;
        return $this;
    }
    
    /**
     * Set order of columns to be displayed
     * @param   array   $columnOrder                        New Column order you want to display
     * return   object                                   Object of class
     */
    public function setColumnsOrders($columnOrder) {
        $this->colOrder = $columnOrder;
        return $this;
    }

    /**
     * Add tool tip
     * @param   string   $elementName                        element for which tooltip needs to be added
     * @param   string   $toolTip                            tooltip to be added
     * @param   string   $type                               type of element whether element or column
     * return   object                                       Object of class
     */
    public function addTooltip($elementName, $toolTip, $type = "field") {
        $this->tooltip[$elementName] = array(
            "toolTip" => $toolTip,
            "type" => $type
        );
        return $this;
    }
    
    /**
     * Get related column data as list from other tables
     * @param   string   $mainTableCol                            Column name of the main table
     * @param   string   $relTable                                Related table name
     * @param   mixed    $relTableCol                             Matching related table columns
     * @param   mixed    $relDisplayCol                           Related table column to be display
     * @param   mixed    $fieldType                               Field type to be displayed for that field, default is "select", if empty, then textarea will be shown
     * return   object                                            Object of class
     */
    public function relatedData($mainTableCol, $relTable, $relTableCol, $relDisplayCol, $fieldType = "select") {
        $this->relData[] = array(
                                "mainTableCol" => $mainTableCol,
                                "relTable" => $relTable,
                                "relTableCol" => $relTableCol,
                                "relDisplayCol" => $relDisplayCol,
                                "fieldType"=>$fieldType);
        if(!empty($fieldType)){
            $this->fieldTypes($mainTableCol, $fieldType);
            $this->fieldDataBinding($mainTableCol, $relTable, $relTableCol, $relDisplayCol, "db");
        }
        return $this;
    }

    /**
     * Rename a export/print column heading
     * @param   string   $colName                            column name to renamed
     * @param   string   $newName                            new column name to be used
     * return   object                                       Object of class
     */
    public function exportColHeading($colName, $newName) {
        $this->exportColName[$colName] = $newName;
        return $this;
    }

    /**
     * Add where condition
     * @param   string   $colName                          column name for which where condition to be applied
     * @param   string   $val                              value of column
     * @param   string   $operator                         any operator like =, !=, default value is "="
     * @param   string   $andOroperator                    whether to use "and" or "or" operator, if empty, default andOrOperator = "and" will be used
     * @param   string   $bracket                          whether to use opening "(" or closing bracket ")", leave empty if not required
     * return   object                                     Object of class
     */
    public function where($colName, $val, $operator = "=", $andOroperator = "", $bracket = "") {
        $this->whereCondition[] = array(
            "val" => $val,
            "operator" => $operator,
            "andOroperator" => $andOroperator,
            "bracket" => $bracket,
            "colName" => $colName
        );
        return $this;
    }

    /**
     * Set whether current operation is back button operation or not
     * @param   bool   $operation                              true/false, current operation is back button operation or not 
     * return   object                                         Object of class
     */
    public function setBackOperation($operation = true) {
        $this->backOperation = $operation;
        return $this;
    }

    /**
     * Set search operator
     * @param   string   $operator                             Set search operator 'like', '>', '>=', '<','=<' etc
     * return   object                                         Object of class
     */
    public function setSearchOperator($operator = "=") {
        $this->searchOperator = $operator;
        return $this;
    }

    /**
     * whether current call is direct or called usign CRUD operation
     * @param   bool   $show                              true/false, whether current call is direct or called usign CRUD operation
     * return   object                                    Object of class
     */
    public function crudCall($show = false) {
        $this->crudCall = $show;
        return $this;
    }

    /**
     * Add advanced filter option
     * @param   string   $filterName                            unique filter name
     * @param   string   $displayText                           display text for filter
     * @param   string   $matchingCol                           column to be matched
     * @param   string   $filterType                            type of filter , default is radio button
     * return   object                                          Object of class
     */
    public function addFilter($filterName, $displayText, $matchingCol, $filterType) {
        $this->crudFilter[$filterName] = array("displayText" => $displayText,
            "matchingCol" => $matchingCol,
            "filterType" => $filterType);
        return $this;
    }

    /**
     * Set data source of filter
     * @param   string  $filterName                            unique filter name
     * @param   mixed   $dataSource                            data source either tablename or array of data
     * @param   string  $key                                   name of col, that will serve as data key
     * @param   string  $val                                   name of col, that will serve as field valye
     * @param   string  $bind                                  whether datasource is db table or array, default is db table
     * return   object                                         Object of class
     */
    public function setFilterSource($filterName, $dataSource, $key, $val, $bind = "db") {
        $this->crudFilterSource[$filterName] = array("dataSource" => $dataSource,
            "key" => $key,
            "val" => $val,
            "bind" => $bind);
        return $this;
    }

    /**
     * Add advanced search options
     * @param   array  $columns                                 Column names to be searched
     * return   object                                         Object of class
     */
    public function addAdvSearch($columns) {
        $this->advSearch = $columns;
        return $this;
    }

    /**
     * Set data source of advance search columns
     * @param   string  $columnName                            column name to be searched
     * @param   mixed   $dataSource                            data source either tablename or array of data
     * @param   string  $key                                   name of col, that will serve as data key
     * @param   string  $val                                   name of col, that will serve as field valye
     * @param   string  $bind                                  whether datasource is db table or array, default is db table
     * return   object                                         Object of class
     */
    public function setAdvSearchSource($columnName, $dataSource, $key, $val, $bind = "db") {
        $this->advSearchDataSource[$columnName] = array("dataSource" => $dataSource,
            "key" => $key,
            "val" => $val,
            "bind" => $bind);
        return $this;
    }

    /**
     * Add advanced search column parameter
     * @param   string   $columnName                            unique filter name
     * @param   string   $displayText                           display text for filter
     * @param   string   $searchType                            type of filter , default is radio button
     * return   object                                          Object of class
     */
    public function setAdvSearchParam($columnName, $displayText, $searchType) {
        $this->advSearchParam[$columnName] = array("displayText" => $displayText,
            "searchType" => $searchType);
        return $this;
    }

    /**
     * Trigger another operation after current operation completed e.g. update another table's data 
     * @param   string   $tableName                            unique table name 
     * @param   array    $colVal                               array of column name and value
     * @param   array    $where                                where condition with column name and value
     * @param   string   $operationType                        operation type i.e. insert update or delete
     * @param   string   $event                                At which event, we need to perform this operation i.e. before_update, after_update
     * return   object                                         Object of class
     */
    public function setTriggerOperation($tableName, $colVal, $where, $operationType = "update", $event = "after_update") {
        $this->triggerOperation[$tableName] = array("colVal" => $colVal, "where" => $where, "operationType" => $operationType);
        $this->addCallback($event, array($this, 'callbackTriggerOperation'));
        return $this;
    }

    /**
     * Add sidebar to existing data in edit/view form
     * @param   string   $sidebarImage                        column name of image or url of image
     * @param   string   $sidebarHeading1                     column name for sidebar heading 1 or some text
     * @param   string   $sidebarHeading2                     column name for sidebar heading 2 or some text
     * @param   array    $sidebarURLs                         sidebar urls
     * @param   string   $position                            Position of the sidebar (either left or right)
     * return   object                                        Object of class
     */
    public function addSidebar($sidebarImage, $sidebarHeading1, $sidebarHeading2, $sidebarURLs, $position = "left") {
        $this->sidebar = array("sidebar_image" => $sidebarImage, "sidebar_heading_1" => $sidebarHeading1, "sidebar_heading_2" => $sidebarHeading2, "sidebar_urls" => $sidebarURLs, "position" => $position);
        return $this;
    }

    /**
     * set whether to delete join table data or not
     * @param   bool  $delJoinTableData                                set true to delete the join table data else false
     * return   object                                         Object of class
     */
    public function setDelJoinTableData($delJoinTableData = true) {
        $this->delJoinTableData = $delJoinTableData;
        return $this;
    }

    /**
     * enqueue col based actions
     * @param   array   $action                               action values
     * @param   string  $type                                 type of action
     * @param   mixed   $text                                 text to be used
     * @param   string  $colName                              name of column
     * @param   array   $attr                                 attribute of columns
     * return   object                                        Object of class
     */
    public function enqueueActions($action, $type = "switch", $text = "", $colName = "", $attr = array()) {
        $this->actions[$this->getRandomKey(false)] = array(
            $colName,
            $action,
            $type,
            $text,
            $attr
        );
        return $this;
    }

    /**
     * enqueue button actions
     * @param   array    $actionName                           name of acion
     * @param   mixed    $action                               action values
     * @param   string   $type                                 type of action
     * @param   mixed    $text                                 text to be used
     * @param   string   $colName                              name of column
     * @param   array    $attr                                 attribute of columns
     * @param   string   $cssClass                             Css Class of buton
     * return   object                                         Object of class
     */
    public function enqueueBtnActions($actionName, $action, $type = "switch", $text = "", $colName = "", $attr = array(),$cssClass = "") {
        $url = "javascript:;";
        switch ($type) {
            case "url": $url = $action;
                break;
            default: $url = "javascript:;";
                break;
        }
        $this->btnActions[strtolower($actionName)] = array(
            $this->getRandomKey(false),
            $colName,
            $action,
            $type,
            $text,
            $attr,
            $url,
            $cssClass
        );
        return $this;
    }
    
     /**
     * enqueue button actions
     * @param   array    $actionName                           name of acion
     * @param   mixed    $text                                 text to be used
     * @param   string    $url                                 url 
     * @param   array    $attr                                 attribute of columns
     * @param   string   $cssClass                             Css Class of buton
     * return   object                                         Object of class
     */
    public function enqueueBtnTopActions($actionName, $text = "",$url ="javascript:;", $attr = array(),$cssClass = "") {
        $this->btnTopAction[strtolower($actionName)] = array(
            $this->getRandomKey(false),
            $text,
            $attr,
            $url,
            $cssClass
        );
        return $this;
    }

    /**
     * dequeue button actions
     * return   object                                         Object of class
     */
    public function dequeueBtnActions() {
        unset($this->btnActions);
        $this->btnActions = array();
        return $this;
    }

    /**
     * Add some html content in the form (normally added at the end of form)
     * @param   string   $html                            html content to be added
     * return   object                                         Object of class
     */
    public function enqueueHTMLContent($html) {
        $this->HTMLContent[] = $html;
        return $this;
    }

    /**
     * Send email with password to email address
     * @param   string   $email                                 Email field of the table
     * @param   string   $password                              password field of the table
     * @param   string   $from                                  from email to be used to send email
     * @param   string   $subject                               subject of the email
     * @param   string   $message                               message of the meail
     * @param   string   $encryption                            encryption to be used, default type md5
     * return   object                                          Object of class
     */
    public function forgotPassword($email, $password, $from = array(), $subject = "", $message = "", $encryption = "md5") {
        if (empty($subject))
            $subject = $this->getLangData("forgot_password_subject");
        $this->forgotPass = array("email" => $email, "password" => $password, "from" => $from, "subject" => $subject, "message" => $message, "encryption" => "encryption");
        $this->formFields(array($email));
        $this->addCallback("after_select", array($this, 'emailPassword'));
        return $this;
    }
    
     /**
     * Checks for duplicate record before inserting data
     * @param   array   $fields                            fields to be checked for duplicacy 
    * return   object                                         Object of class
     */
    public function checkDuplicateRecord($fields) {
        $this->checkDuplicate = $fields;
        return $this;
    }

    /**
     * Add recaptcha
     * @param   string   $siteKey                            site key 
     * @param   string   $secret                             secret 
     * return   object                                       Object of class
     */
    public function recaptcha($siteKey, $secret) {
        $this->recaptcha[$siteKey] = $secret;
        $this->formStaticFields("recaptcha", "html", "<div class=\"g-recaptcha\" id=\"pdo_recaptcha\" data-sitekey=\"$siteKey\"></div>");
        $this->enqueueJs("recaptcha", $this->settings["recaptchaurl"]);
        $this->jsSettings["site_key"] = $siteKey;
        return $this;
    }

    /**
     * Add data type of search column
     * @param   string   $columnName                           name of column
     * @param   string   $dataType                             data type e.g. datetime 
     * return   object                                         Object of class
     */
    public function setSearchColumnDataType($columnName, $dataType) {
        $this->searchColDataType[$columnName] = $dataType;
        return $this;
    }
    
    /**
     * Add date range report buttons (eg daily ,monthly ,yearly report button)
     * @param   string   $text                          Name/Text of the button
     * @param   string   $type                          Type of the report to be generated.
     * return   object                                  Object of class
     */
    public function addDateRangeReport($text, $type, $dateField) {
        $this->dateRangeReport[$this->getRandomKey()] = array("text" =>$text, "type" => $type, "dateField" => $dateField);
        return $this;
    }
    
    /**
     * Export complete database
     * @param   string   $filename                          File name 
     * @param   string   $includeTables                     Include particular tables
     * @param   string   $excludeTables                     Exclude particular tables
     * return   object                                      Object of class
     */
    public function exportDB($filename, $includeTables = array(), $excludeTables = array()) {
        require_once(dirname(__FILE__) . "/library/shuttle-export-master/dumper.php");
        $db = array(
            'host' => $this->settings["hostname"],
            'username' => $this->settings["username"],
            'password' => $this->settings["password"],
            'db_name' => $this->settings["database"]);
        if (is_array($includeTables) && count($includeTables))
            $db["include_tables"] = $includeTables;
        if (is_array($excludeTables) && count($excludeTables))
            $db["exclude_tables"] = $excludeTables;
        
        $dumpDB = Shuttle_Dumper::create($db);
        $dumpDB->dump($this->fileSavePath .$filename);
        return $this;
    }

    /**
     * Set session for select operation for user login management. By default, it checks value 
     * against database table, if it doesn't find value in database tab;e then value will be treated as string and will 
     * be saved in session.
     * 
     * @param   string   $sessionName                          Name/Text of the session
     * @param   string   $val                                  Value of the session (column name of table or some fixed value)
     * return   object                                         Object of class
     */
    public function setUserSession($sessionName, $val) {
        $this->session[$sessionName] = $val;
        return $this;
    }
    
    /**
     * Get array of sessions or particular session value, set by user for user management functionality using setSession function
     * @param   string   $sessionKey                          session key that needs to be retrived (optional)
     * return   array                                         sesion set by user using setSession function
     */
    public function getUserSession($sessionKey = "") {
        if (isset($_SESSION["pdocrud_user"]) && count($_SESSION["pdocrud_user"])) {
            if (!empty($sessionKey) && isset($_SESSION["pdocrud_user"][$sessionKey])){
                return $_SESSION["pdocrud_user"][$sessionKey];
            }
            else{
                return $_SESSION["pdocrud_user"];
            }
        } else
            return array();
    }
    
    /**
     * Unset array of sessions or particular session value, set by user for user management functionality using setSession function
     * @param   string   $sessionKey                          session key that needs to be unset (optional)
     * return   bool                                          If session is unset successfully, return true else return false
     */
    public function unsetUserSession($sessionKey = "") {
        if (isset($_SESSION["pdocrud_user"]) && count($_SESSION["pdocrud_user"])) {
            if (!empty($sessionKey) && isset($_SESSION["pdocrud_user"][$sessionKey])){
                unset($_SESSION["pdocrud_user"][$sessionKey]);
                return true;
            }
            else{
                unset($_SESSION["pdocrud_user"]);
                return true;
            }
        } else
            return false;
    }

    /**
     * Check whether session is set or not by user for user management functionality using setSession function
     * return   bool                                         return true/false depending upon session set or not
     */
    public function checkUserSession($sessionKey = "", $val = array()) {
        if (isset($_SESSION["pdocrud_user"]) && count($_SESSION["pdocrud_user"])) {
            if (!empty($sessionKey)) {
                if (is_array($val) && count($val)) {
                    if (isset($_SESSION["pdocrud_user"][$sessionKey]) && in_array($_SESSION["pdocrud_user"][$sessionKey], $val)) {
                        return true;
                    } else {
                        return false;
                    }
                }
                else if (!isset($_SESSION["pdocrud_user"][$sessionKey])) {
                    return false;
                }
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * Add pie chart, bar chart, google charts etc using add chart function
     * @param   string  $chartName                            Name of the chart
     * @param   string  $chartType                            Chart type 
     * @param   mixed   $dataSource                           data source either tablename or array of data
     * @param   string  $key                                  name of col, that will serve as data key
     * @param   string  $val                                  name of col, that will serve as field valye
     * @param   string  $bind                                 whether datasource is db table or array or sql, default is db table
     * @param   string  $param                                data parameter for the chart element
     * return   object                                        Object of class
     */
    public function addChart($chartName, $chartType, $dataSource, $key, $val, $bind = "db", $param = array()) {
        switch (strtolower($chartType)) {
            case "easypie": $this->addPlugin("jquery-easy-pie-chart");
                break;
            case "sparkline": $this->addPlugin("sparkline");
                break;
            case "google-chart": $this->addPlugin("google-chart");
                break;
            default : $this->addError("");
                return;
        }
        $this->chart[$chartName] = array("chartType" => $chartType, "dataSource" => $dataSource, "key" => $key, "val" => $val, "bind" => $bind, "param" => $param);
        return $this;
    }

    /**
     * Modify the file upload path and download path later
     * @param   string  $uploadPath                              Path of upload folder
     * @param   string  $downloadPath                            Path of download folder
     * return   object                                           Object of class
     */
    public function fileSavePath($uploadPath = "", $downloadPath = "") {
        if (!empty($uploadPath))
            $this->fileUploadPath = $uploadPath;
        if (!empty($downloadPath))
            $this->fileSavePath = $downloadPath;
    }

    /**
     * Output html content and clears html content, can be called at specific places to output content
     * @param   bool   $output                            if true output the content else return the content.
     * return   mixed                                     Object of class or html content
     */
    public function outputHTMLContent($output = true) {
        $html = $this->pdocrudView->outputHTMLContent($this->HTMLContent);
        $this->HTMLContent = array();
        if ($output)
            echo $html;
        else
            return $html;
        return $this;
    }

    public function outputChartCode($output = true) {
        if (isset($this->chart)) {
            $html = "";
            $pluginName = "";
            foreach ($this->chart as $key => $val) {
                switch (strtolower($val["chartType"])) {
                    case "easypie": $pluginName = "jquery-easy-pie-chart";
                        $key ="#" . $key;
                        break;
                    case "sparkline": $pluginName = "sparkline";
                        $val["param"] = array();
                        $key ="#" . $key;
                        break;
                    case "google-chart": $pluginName = "google-chart";
                        $val["param"] = array();
                        if(isset($this->chartData[$key]))
                            $val["param"] = $this->chartData[$key];
                        break;
                    default: break;
                }
                $html.= $this->loadPluginJsCode($pluginName, $key, $val["param"]);
            }
            if ($output)
                echo $html;
            else
                return $html;
        }
    }

    private function initializeHTMLContent() {
        $this->HTMLContent[] = $this->getAjaxLoaderImage($this->settings["script_url"] . "script/images/ajax-loader.gif");
        return $this;
    }

    /**
     * Initialize plugins to be loaded directly from the config file
     * return   object                                     Object of class
     */
    private function initializePlugins() {
        if (isset($this->settings["loadJsPlugins"])) {
            if (is_array($this->settings["loadJsPlugins"]) && count($this->settings["loadJsPlugins"])) {
                foreach ($this->settings["loadJsPlugins"] as $pluginName) {
                    $this->addPlugin($pluginName);
                }
            }
        }
        unset($this->settings["loadJsPlugins"]);
    }

    /**
     * Add js/css based plugin, plugin needs to be placed inside plugins folder with js files under js folder and css files under css folder
     * @param   string   $pluginName                     Name of the plugin to be added, make sure plugins folder is readable
     * return   object                                    Object of class
     */
    public function addPlugin($pluginName) {
        $this->plugins["css"][$pluginName] = $this->getDirFiles(PDOCrudABSPATH . "plugins/" . $pluginName . "/css/", "css");
        $this->plugins["js"][$pluginName] = $this->getDirFiles(PDOCrudABSPATH . "plugins/" . $pluginName . "/js/", "js");
        return $this;
    }

    private function enqueuePlugin() {
        $pluginPath = $this->settings["script_url"] . "script/plugins/";

        if (isset($this->plugins["js"])) {
            foreach ($this->plugins["js"] as $jsPluginName => $jsPlugins) {
                foreach ($jsPlugins as $jsPlugin) {
                    $this->enqueueJs($jsPlugin, $pluginPath . $jsPluginName . "/js/" . $jsPlugin);
                }
            }
        }

        if (isset($this->plugins["css"])) {
            foreach ($this->plugins["css"] as $cssPluginName => $cssPlugins) {
                foreach ($cssPlugins as $cssPlugin) {
                    $this->enqueueCss($cssPlugin, $pluginPath . $cssPluginName . "/css/" . $cssPlugin);
                }
            }
        }

        unset($this->plugins["js"]);
        unset($this->plugins["css"]);
    }

    /**
     * Add javascript by specify js name and path of js, it will be loaded with other scripts
     * @param   string   $jsName                     Name of javascript to be loaded
     * @param   string   $jsPath                     Path of javascript to be loaded
     * return   object                               Object of class
     */
    public function enqueueJs($jsName, $jsPath) {
        $this->js[strtolower($jsName)] = $jsPath;
        return $this;
    }

    /**
     * Add directly javascript
     * @param   string   $applyOn                     Apply on element name
     * @param   string   $applyOnVal                  Value to be used of that element
     * @param   string   $functionName                function name
     * @param   string   $action                      action to be used 
     * @param   string   $options                     options for that function
     * return   object                                Object of class
     */
    public function applyJS($applyOn, $applyOnVal, $functionName, $action = "on_form_load", $options = array()) {
        $this->colApplyJs[$applyOn][] = array(
            "functionName" => $functionName,
            "applyOnVal" => $applyOnVal,
            "action" => $action,
            "options" => $options
        );
        return $this;
    }

    /**
     * Removes already enqueue js, useful for removing js that are already included in your page
     * @param   string   $jsName                     Name of javascript to be removed
     * return   object                               Object of class
     */
    public function unsetJs($jsName) {
        unset($this->js[strtolower($jsName)]);
        return $this;
    }

    /**
     * Multi Table Relation (nested table) - Editing of related records in other table
     * @param   string   $field1                     field name of object to matched
     * @param   string   $field2                     field name of 2nd object to be matched
     * @param   PDOCrud  $obj                        2nd table (object)
     * @param   string   $renderParam                render type, default is CRUD
     * return   object                               Object of class
     */
    public function multiTableRelation($field1, $field2, $obj, $renderParam = "CRUD") {
        $this->multiTableRelation[] = array("field1" => $field1, "field2" => $field2, "obj" => $obj, "renderParam" => $renderParam);
        return $this;
    }

    /**
     * Set display type of table and title in case of tabs
     * @param   string   $display                         display type e.g. tab
     * @param   string   $title                           title of tab
     * return   mixed                                     Object of class or js content
     */
    public function multiTableRelationDisplay($display, $title) {
        $this->multiTableRelationDisplay = array("display" => $display, "title" => $title);
        return $this;
    }

    /**
     * Output js
     * @param   bool   $output                            if true output the content else return the content.
     * return   mixed                                     Object of class or js content
     */
    public function outputJs($output = true) {
        $js = $this->pdocrudView->outputJs($this->js);
        $this->js = array();
        if ($output)
            echo $js;
        else
            return $js;
        return $this;
    }

    /**
     * Output javascript added using the apply js
     * @param   bool   $output                            if true output the content else return the content.
     * return   mixed                                     Object of class or js content
     */
    public function outputApplyJs($output = true) {
        $js = $this->pdocrudView->outputApplyJs($this->colApplyJs);
        $this->colApplyJs = array();
        if ($output)
            echo $js;
        else
            return $js;
        return $this;
    }

    /**
     * Add callback function to be called on certain event
     * @param   string   $eventName                       Eventname for which callback function needs to be called
     * @param   string   $callback                        Name of callback function
     * return   object                                    Object of class
     */
    public function addCallback($eventName, $callback) {
        $this->callback[$eventName][] = $callback;
        return $this;
    }

    private function handleCallback($eventName, $data) {
        if (isset($this->callback[$eventName])) {
            foreach ($this->callback[$eventName] as $callback) {
                if (is_callable($callback))
                    return call_user_func($callback, $data, $this);
            }
        }
        return $data;
    }

    /**
     * Loads plugin js code, must be called after render function
     * @param   string   $pluginName                      Name of plugin
     * @param   string   $elementName                     Element name for which plugin needs to be called
     * @param   array    $params                          list of parameters/options for the plugin js code
     * return   string                                    String of js code
     */
    public function loadPluginJsCode($pluginName, $elementName, $params = array()) {
        ob_start();
        require PDOCrudABSPATH . "classes/plugin-helper/plugin-$pluginName.php";
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }

    private function initializeJsSettings() {
        $this->jsSettings["pdocrudurl"] = $this->settings["script_url"];
        $this->jsSettings["date"]["time_format"] = $this->settings["timeformat"];
        $this->jsSettings["date"]["date_format"] = $this->settings["dateformat"];
        $this->jsSettings["date"]["change_month"] = $this->settings["changeMonth"];
        $this->jsSettings["date"]["change_year"] = $this->settings["changeYear"];
        $this->jsSettings["date"]["no_of_month"] = $this->settings["numberOfMonths"];
        $this->jsSettings["date"]["show_button_panel"] = $this->settings["showButtonPanel"];
        $this->jsSettings["submission_type"] = $this->settings["submissionType"];
        $this->jsSettings["jsvalidation"] = $this->settings["jsvalidation"];
        $this->jsSettings["auto_suggestion"] = isset($this->settings["autoSuggestion"]) ? $this->settings["autoSuggestion"] : false;
        $this->jsSettings["lang"]["invalid_email"] = $this->getLangData("invalid_email");
        $this->jsSettings["lang"]["invalid_date"] = $this->getLangData("invalid_date");
        $this->jsSettings["lang"]["req_field"] = $this->getLangData("req_field");
        $this->jsSettings["lang"]["min_length"] = $this->getLangData("min_length");
        $this->jsSettings["lang"]["max_length"] = $this->getLangData("max_length");
        $this->jsSettings["lang"]["equal_length"] = $this->getLangData("equal_length");
        $this->jsSettings["lang"]["delete_select_records"] = $this->getLangData("delete_select_records");
        $this->jsSettings["lang"]["select_one_entry"] = $this->getLangData("select_one_entry");
        $this->jsSettings["lang"]["delete_single_record"] = $this->getLangData("delete_single_record");
        $this->jsSettings["lang"]["recaptcha_msg"] = $this->getLangData("recaptcha_msg");
        $this->jsSettings["reset_form"] = $this->settings["resetForm"];
        $this->jsSettings["quick_view"] = $this->settings["quickView"];
        $this->jsSettings["checkbox_validation"] = $this->settings["checkboxValidation"];
        if(isset($this->settings["max_date"]))
            $this->jsSettings["date"]["max_date"] = $this->settings["max_date"];
        if(isset($this->settings["min_date"]))
            $this->jsSettings["date"]["min_date"] = $this->settings["min_date"];
    }

    private function outputJsSettings($output = true) {
        $js = $this->pdocrudView->outputJsSetting($this->jsSettings);
        $this->jsSettings = array();
        if ($output)
            echo $js;
        else
            return $js;
        return $this;
    }

    private function registerJs() {
        $jsLists = array();
        $templateName = strtolower($this->settings["template"]);
        $scripturl = $this->settings["script_url"];
        $loadInitialJs = $this->settings["loadJs"];

        foreach ($loadInitialJs as $js) {
            $jsLists[$js] = $scripturl . "script/js/$js";
        }
        if (!isset($this->settings["includeTemplateJS"]) || (isset($this->settings["includeTemplateJS"]) && $this->settings["includeTemplateJS"])) {
            $jsLists["template-script"] = $scripturl . "script/classes/templates/" . $templateName . "/js/script.js";
        } 
        $jsLists["pdocrud-script"] = $scripturl . "script/js/comman.js";

        foreach ($jsLists as $jsName => $jsPath) {
            $this->enqueueJs($jsName, $jsPath);
        }
    }

    /**
     * Set skin 
     * @param   mixed    $skin                        Name of skin
     * return   object                                Object of class
     */
    public function setSkin($skin) {
        $this->settings["skin"] = $skin;
        $scripturl = $this->settings["script_url"];
        if (is_array($skin)) {
            foreach ($skin as $sk) {
                $cssPath = $scripturl . "script/skin/" . $sk . ".css";
                $this->enqueueCss($sk, $cssPath);
            }
        } else {
            $cssPath = $scripturl . "script/skin/" . $skin . ".css";
            $this->enqueueCss("skin", $cssPath);
        }
        return $this;
    }

    /**
     * Add css by specify css name and path of css, it will be loaded with other css
     * @param   string   $cssName                     Name of css to be loaded
     * @param   string   $cssPath                     Path of css to be loaded
     * return   object                                Object of class
     */
    public function enqueueCss($cssName, $cssPath) {
        $this->css[strtolower($cssName)] = $cssPath;
        return $this;
    }

    /**
     * Removes already enqueue css, useful for removing css that are already included in your page
     * @param   string   $cssName                     Name of css to be removed
     * return   object                                Object of class
     */
    public function unsetCss($cssName) {
        unset($this->css[$cssName]);
        return $this;
    }

    /**
     * Output css
     * @param   bool   $output                            if true output the content else return the content.
     * return   mixed                                     Object of class or css content
     */
    public function outputCss($output = true) {
        $css = $this->pdocrudView->outputCss($this->css);
        $this->css = array();
        if ($output)
            echo $css;
        else
            return $css;
        return $this;
    }

    private function registerCss() {
        $cssLists = array();
        $templateName = strtolower($this->settings["template"]);
        $scripturl = $this->settings["script_url"];
        $loadInitialCss = $this->settings["loadCss"];

        foreach ($loadInitialCss as $css) {
            $cssLists[$css] = $this->settings["script_url"] . "script/css/$css";
        }
        
        if (!isset($this->settings["includeTemplateCSS"]) || (isset($this->settings["includeTemplateCSS"]) && $this->settings["includeTemplateCSS"])) {
            $cssLists["template-css"] = $scripturl . "script/classes/templates/" . $templateName . "/css/style.css";
        }
        foreach ($cssLists as $cssName => $cssPath) {
            $this->enqueueCss($cssName, $cssPath);
        }

        $skin = strtolower($this->settings["skin"]);
        $cssPath = $scripturl . "script/skin/" . $skin . ".css";
        $this->enqueueCss("skin", $cssPath);
    }

    /**
     * Set current language
     * @param   string   $lang                            language to be used
     * return   object                                    Object of class
     */
    public function setCurrentLang($lang) {
        $this->currentLang = $lang;
    }

    private function loadLangData() {
        $file = PDOCrudABSPATH . '/languages/' . $this->currentLang . '.ini';
        if (!file_exists($file)) {
            $this->currentLang = "en";
            $file = PDOCrudABSPATH . '/languages/' . $this->currentLang . '.ini';
        }

        $this->langData = parse_ini_file($file);
    }

    /**
     * Return language data
     * @param   string   $param                           Get data for language
     * return   sting                                     language translation for the parameter
     */
    public function getLangData($param) {
        if (isset($this->langData[$param]))
            return $this->langData[$param];
        return $param;
    }

    /**
     * Set language data
     * @param   string   $param                          lanuguage key for which data needs to save
     * @param   string   $val                            Value for the language parameter
     * return   object                                   Object of class
     */
    public function setLangData($param, $val) {
        $this->langData[$param] = $val;
        return $this;
    }

    /**
     * Set portfolio column
     * @param   int   $columns                          no of columns to be used per row
     * return   object                                   Object of class
     */
    public function setPortfolioColumn($columns) {
        $this->portfolioCol = $columns;
        return $this;
    }
    
    /**
     * Set Form skin 
     * @param   string   $skin                        Name of skin
     * return   object                                Object of class
     */
    public function setFormSkin($skin) {
        $scripturl = $this->settings["script_url"];
        $cssPath = $scripturl . "script/skin/" . $skin . ".css";
        $this->enqueueCss("skin", $cssPath);
        return $this;
    }

    private function savePDOCrudObj() {
        @session_start();
        if (!$this->multi) {
            if (isset($_SESSION["pdocrud_sess"][$this->objKey]))
                unset($_SESSION["pdocrud_sess"][$this->objKey]);
        }
        $_SESSION["pdocrud_sess"][$this->objKey] = serialize($this);
        if (!isset($_SESSION["pdocrud_sess"][$this->objKey]))
            $_SESSION["pdocrud_sess"][$this->objKey] = serialize($this);
    }

    public function render($operationType = "CRUD", $data = array()) {
        if ($this->validate($operationType, $data)) {
            $this->initializeBtnActions();
            $this->enqueuePlugin();
            $output = $this->outputCss(false);
            $output .= $this->handleOperation($operationType, $data);
            $output .= $this->outputJs(false);
            $output .= $this->outputJsSettings(false);
            $output .= $this->outputApplyJs(false);
            $output .= $this->outputHTMLContent(false);
            $output .= $this->outputChartCode(false);
            $this->resetFields();
            $this->savePDOCrudObj();
            return $output;
        }
    }

    public function resetFields() {
        $this->dataHTML = array();
        $this->fieldList = array();
    }

    /**
     * Return errors
     * return array                                   array of error list
     */
    public function getErrors() {
        return $this->pdocrudErrCtrl->getErrors();
    }

    /**     * ***************** private functions ************************************* */
    private function validate($operationType, $data) {

        if (empty($this->tableName) && empty($this->sql) && !isset($this->chart) && ($operationType !== "HTML")) {
            $this->addError($this->getLangData("error_missing_table"));
            return false;
        }

        switch ($operationType) {
            case "EDIT":
                if (!isset($data["id"])) {
                    $this->addError($this->getLangData("error_primary_key"));
                    return false;
                }
        }

        return true;
    }

    private function handleOperation($operationType = "CRUD", $data = array()) {
        $this->op = $operationType;
        switch (strtoupper($operationType)) {
            case "CRUD":
                return $this->dbCRUD($data);
            case "ADVSEARCH":
                return $this->dbAdvSearch($data);
            case "INSERT":
                return $this->dbInsert($data);
            case "UPDATE":
                return $this->dbUpdate($data);
            case "SAVE_CRUD_DATA":
                return $this->dbSaveCrudData($data);
            case "SELECT":
                return $this->dbSelect($data);
            case "SWITCH":
                return $this->dbSwitch($data);
            case "BTNSWITCH":
                return $this->dbBtnSwitch($data);
            case "SQL":
                return $this->dbSQL($data);
            case "SELECTFORM":
                return $this->getSelectForm();
            case "INSERTFORM":
                return $this->getInsertForm();
            case "EDITFORM":
                return $this->getEditForm($data);
            case "VIEWFORM":
                return $this->getViewForm($data);
            case "LOADDEPENDENT":
                return $this->getDependentData($data);
            case "EXPORTFORM":
                return $this->exportFormData($data);
            case "EXPORTTABLE":
                return $this->exportTableData($data);
            case "EMAILFORM":
                return $this->getEmailForm("email");
            case "EMAIL":
                return $this->emailData($data);
            case "DELETE":
                return $this->dbDelete($data);
            case "DELETE_SELECTED":
                return $this->dbDeleteSelected($data);
            case "ONEPAGE":
                return $this->dbOnePage($data);
            case "QUICKVIEW":
                return $this->dbQuickView($data);  
            case "RELATED_TABLE":
                return $this->dbRelatedTableView($data);      
            case "CHART":
                return $this->showChart($data);
            case "HTML":
                return $this->addHTML($data);
            case "IMPORT":
                return $this->importFile($data);
            case "CLONEFORM":
                return $this->getCloneForm($data); 
            case "AUTOSUGGEST":
                return $this->getAutoSuggestData($data); 
            case "CELL_UPDATE":
                return $this->dbCellUpdate($data);    
            default:
                $this->addError($this->getLangData("error_valid_render_option"));
        }
    }

    private function dbSelect($data) {
        $this->message = "";
        $pdoModelObj = $this->getPDOModelObj();
        $selectData = $this->formatFormData($data);
        $selectData = $this->handleCallback('before_select', $selectData);
        foreach ($selectData[$this->tableName] as $column => $value) {
            $pdoModelObj->where($column, $value);
        }
        $result = $pdoModelObj->select($this->tableName);

        if ($pdoModelObj->totalRows > 0)
            $this->message = $this->getLangData("success");
        else{
            $this->message = $this->getLangData("no_data");
            if(isset($this->formRedirection["reset"]) && $this->formRedirection["reset"])
                $this->formRedirection["redirectionURL"] = "";
        }

        if (isset($this->session) && count($this->session) && count($result)) {
            @session_start();
            unset($_SESSION["pdocrud_user"]);
            foreach ($this->session as $key => $val) {
                $value = $val;
                if (isset($result[0][$val]))
                    $value = $result[0][$val];
                $_SESSION["pdocrud_user"][$key] = $value;
            }
        }
        $result = $this->handleCallback('after_select', $result);
        echo $this->getResponse($result);
    }

    private function dbInsert($data) {
        $this->message = "";
        $pdoModelObj = $this->getPDOModelObj();
        $insertData = $this->formatFormData($data);
        $insertData = $this->handleCallback('before_insert', $insertData);
        if (isset($this->checkDuplicate) && is_array($this->checkDuplicate) && count($this->checkDuplicate)) {
            if ($this->checkDuplicateData($this->checkDuplicate, $insertData)) {
                $this->message = $this->getLangData("record_already_exists");
                return $this->getResponse($insertData);
            }
        }
        $pdoModelObj->insert($this->tableName, $insertData[$this->tableName]);
        $lastInsertId = $pdoModelObj->lastInsertId;
        $this->dbSaveJoinData($pdoModelObj, $insertData, $lastInsertId);
        $this->handleCallback('after_insert', $lastInsertId);
        if ($pdoModelObj->rowsChanged > 0)
            $this->message = $this->getLangData("success");
        return $this->getResponse($lastInsertId);
    }
    
    private function checkDuplicateData($fields, $data) {
        $pdoModelObj = $this->getPDOModelObj();
        foreach ($fields as $field) {
            $pdoModelObj->where($field, $data[$this->tableName][$field]);
        }
        $selectData = $pdoModelObj->select($this->tableName);
        if (count($selectData))
            return true;
        return false;
    }

    private function dbUpdate($data) {
        $pdoModelObj = $this->getPDOModelObj();
        $updateData = $this->formatFormData($data);
        $updateData = $this->handleCallback('before_update', $updateData);
        $pdoModelObj->where($this->pk, $this->pkVal);
        $pdoModelObj->update($this->tableName, $updateData[$this->tableName]);
        $lastInsertId = $this->pkVal;
        $this->dbSaveJoinData($pdoModelObj, $updateData, $lastInsertId, "update");
        $this->handleCallback('after_update', $lastInsertId);
        if ($pdoModelObj->rowsChanged > 0)
            $this->message = $this->getLangData("success");
        return $this->getResponse($pdoModelObj->rowsChanged);
    }

    private function dbSaveCrudData($data) {
        $pdoModelObj = $this->getPDOModelObj();
        $updateData = json_decode($data["updateData"]);
        $rowsUpdate = 0;
        foreach ($updateData as $update) {
            $col = $update->col;
            $pk_val = $update->id;
            $val = $update->val;
            $pdoModelObj->where($this->pk, $pk_val);
            $pdoModelObj->update($this->tableName, array($col => $val));
            $pdoModelObj->resetWhere();
            $rowsUpdate+= $pdoModelObj->rowsChanged;
        }
        if ($rowsUpdate > 0)
            $this->message = $this->getLangData("success");
        else
            $this->message = $this->getLangData("error");
        return $rowsUpdate;
    }

    private function dbDelete($data) {
        $data = $this->handleCallback('before_delete', $data);
        $pdoModelObj = $this->getPDOModelObj();
        $this->pkVal = $data["id"];
        $pdoModelObj->where($this->pk, $this->pkVal);
        $pdoModelObj->delete($this->tableName);
        $this->handleCallback('after_delete', $this->pkVal);
        $this->dbDelJoinData($pdoModelObj, $data, $this->pkVal);
    }

    private function dbDeleteSelected($data) {
        $data = $this->handleCallback('before_delete_selected', $data);
        $pdoModelObj = $this->getPDOModelObj();
        $values = $data["selected_ids"];
        foreach ($values as $value) {
            $pdoModelObj->where($this->pk, $value);
            $pdoModelObj->delete($this->tableName);
            $pdoModelObj->resetAll();
            $this->dbDelJoinData($pdoModelObj, $data, $value);
        }
    }

    private function dbBtnSwitch($data) {
        $pdoModelObj = $this->getPDOModelObj();
        $uniqueId = $data["uniqueId"];
        foreach ($this->btnActions as $btnActions) {
            if ($btnActions[0] === $uniqueId) {
                $colName = $btnActions[1];
                $actions = $btnActions[2];
                $colVal = $actions[$data["columnVal"]];
                $updateData = array($colName => $colVal);
                $updateData = $this->handleCallback('before_btn_switch_update', $updateData);
                $pdoModelObj->where($this->pk, $data["id"]);
                $pdoModelObj->update($this->tableName, $updateData);
                $updateData = $this->handleCallback('after_btn_switch_update', $updateData);
            }
        }
    }

    private function dbSwitch($data) {
        $pdoModelObj = $this->getPDOModelObj();
        $uniqueId = $data["uniqueId"];
        $colName = $this->actions[$uniqueId][0];
        $actions = $this->actions[$uniqueId][1];
        $colVal = $actions[$data["columnVal"]];
        $updateData = array($colName => $colVal);
        $updateData = $this->handleCallback('before_switch_update', $updateData);
        $pdoModelObj->where($this->pk, $data["id"]);
        $pdoModelObj->update($this->tableName, $updateData);
        $updateData = $this->handleCallback('after_switch_update', $updateData);
    }

    private function dbSaveJoinData(PDOModel $pdoModelObj, $data, $lastInsertId, $operation = "insert") {
        if (is_array($this->joinTable) && count($this->joinTable) > 0) {
            foreach ($this->joinTable as $join) {
                if (strtoupper($join["type"]) === "LEFT JOIN") {
                    $keyName = $this->getJoinKeyName($join["condition"]);
                    if ($operation === "update") {
                        $pdoModelObj->resetWhere();
                        $pdoModelObj->resetValues();
                        $pdoModelObj->where($keyName, $this->pkVal);
                        $pdoModelObj->delete($join["table"]);
                    }
                    if ($operation === "delete") {
                        $pdoModelObj->resetWhere();
                        $pdoModelObj->resetValues();
                        $pdoModelObj->where($keyName, $this->pkVal);
                        $pdoModelObj->delete($join["table"]);
                    }

                    $keys = array_keys($data[$join["table"]]);
                    for ($loop = 0; $loop < count($data[$join["table"]][$keys[0]]); $loop++) {
                        $joinData = array();
                        foreach ($data[$join["table"]] as $key => $val) {
                            $joinData[$key] = $val[$loop];
                        }

                        $joinData[$keyName] = $lastInsertId;
                        $pdoModelObj->insert($join["table"], $joinData);
                    }
                } else if (strtoupper($join["type"]) === "INNER JOIN") {
                    $keyName = $this->getJoinKeyName($join["condition"]);
                    $data[$join["table"]][$keyName] = $lastInsertId;
                    $pdoModelObj->resetWhere();
                    $pdoModelObj->resetValues();
                    if ($operation === "update") {
                        $keyVal = $this->getJoinKeyValue($keyName, $data);
                        $data[$join["table"]][$keyName] = $keyVal;
                        $pdoModelObj->where($keyName, $keyVal);
                        $pdoModelObj->update($join["table"], $data[$join["table"]]);
                    } else {
                        $pdoModelObj->insert($join["table"], $data[$join["table"]]);
                    }
                }
            }
        }
    }

    private function dbDelJoinData(PDOModel $pdoModelObj, $data, $lastInsertId, $operation = "delete") {
        if (is_array($this->joinTable) && count($this->joinTable) > 0 && $this->delJoinTableData) {
            foreach ($this->joinTable as $join) {
                if (strtoupper($join["type"]) === "LEFT JOIN") {
                    $keyName = $this->getJoinKeyName($join["condition"]);
                    if ($operation === "delete") {
                        $pdoModelObj->resetWhere();
                        $pdoModelObj->resetValues();
                        $pdoModelObj->where($keyName, $this->pkVal);
                        $pdoModelObj->delete($join["table"]);
                    }
                } else if (strtoupper($join["type"]) === "INNER JOIN") {
                    $keyName = $this->getJoinKeyName($join["condition"]);
                    $pdoModelObj->resetWhere();
                    $pdoModelObj->resetValues();
                    $pdoModelObj->where($keyName, $this->pkVal);
                    $pdoModelObj->delete($join["table"]);
                }
            }
        }
    }

    private function emailData($data) {
        if ($this->formEmail["save_db"])
            $this->dbInsert($data);
        
        $formfields = $this->formatFormData($data);
        $fields = $formfields[$this->tableName];
        $subject = preg_replace_callback('/{{([^}]+)}}/', function($m) use ($fields) {
            return $fields[$m[1]];
        }, $this->formEmail["subject"]);

        if ($this->formEmail["message"] === "default_template") {
            $message = $this->pdocrudView->renderMessage($fields, $this->settings);
        } else {
            $message = preg_replace_callback('/{{([^}]+)}}/', function($m) use ($fields) {
                return $fields[$m[1]];
            }, $this->formEmail["message"]);
        }
        foreach ($this->formEmail["to"] as $toEmail) {
            $to[] = preg_replace_callback('/{{([^}]+)}}/', function($m) use ($fields) {
                return $fields[$m[1]];
            }, $toEmail);
        }
        if ($this->sendEmail($to, $subject, $message, $this->formEmail["from"])) {
            $this->message = $this->getLangData("success");
        }
        return $this->getResponse($this->getLangData("email_success_message"));
    }

    private function formatFormData($values) {
        @session_start();
        $data = array();
        $tableName = "";
        require_once(dirname(__FILE__) . "/library/phpvalidation/pdocrudphpvalidation.php");

        foreach ($values as $field => $val) {
            
            if(isset($this->settings["preventXSS"]) && $this->settings["preventXSS"]){
                $val = $this->cleanInputData($val);
            }
            
            if (strpos($field, 'pdocrud') === false) {
                $encryptedFieldName = $field;
                $fieldName = explode($this->tableFieldJoin, $this->decrypt($field));
                if (isset($fieldName[0]) && isset($fieldName[1])) {
                    $tableName = $fieldName[0];
                    $field = $fieldName[1];

                    if (isset($this->fieldFormula[$field])) {
                        $val = $this->pdoTableFormatObj->formatTableColOptions($field, $this->fieldFormula[$field], $val);
                    }

                    $data[$tableName][$field] = $val;
                    
                    if (is_array($val) && $tableName === $this->tableName && count($val) == count($val, COUNT_RECURSIVE)) {
                        $data[$tableName][$field] = implode(",", $val);
                    }

                    if (isset($this->fieldType[$field])) {
                        if (in_array($this->fieldType[$field]["type"], array("IMAGE", "FILE", "FILE_NEW", "FILE_MULTI"))) {
                            $uploadPath = $this->uploadFormImage($val);
                            if (empty($uploadPath)) {
                                if (isset($values[$encryptedFieldName . "_pdocrud_file_input"]) && !empty($values[$encryptedFieldName . "_pdocrud_file_input"]))
                                    $uploadPath = $values[$encryptedFieldName . "_pdocrud_file_input"];
                            }
                            $data[$tableName][$field] = $uploadPath;
                        }
                        else if($this->fieldType[$field]["type"] === "PASSWORD" && isset($this->fieldType[$field]["parameters"]["encryption"])){
                             $data[$tableName][$field] = $this->encryptPassword($this->fieldType[$field]["parameters"]["encryption"], $val);
                        }
                    }

                    $response = $this->validateField($field, $val, $values);
                    if ($response !== TRUE) {
                        $this->addError($this->getLangData($response));
                        $this->getResponse("validation_error");
                        die();
                    }
            } else if (isset($fieldName[0]) && !isset($fieldName[1])) {
                    $field = $fieldName[0];
                    $tableName = $this->tableName;
                    $data[$tableName][$field] = $val;
                }
            }
            else if (strpos($field, 'pdocruddb') !== false) {
                $field = substr (  $field , 10 ,  strlen($field) - 1);
                $fieldName = explode($this->tableFieldJoin, $this->decrypt($field));
                if (isset($fieldName[0]) && isset($fieldName[1])) {
                    $tableName = $fieldName[0];
                    $field = $fieldName[1];
                     if (isset($this->fieldFormula[$field])) {
                        $val = $this->pdoTableFormatObj->formatTableColOptions($field, $this->fieldFormula[$field], $val);
                    }

                    $data[$tableName][$field] = $val;
                    if (is_array($val) && $tableName === $this->tableName && count($val) == count($val, COUNT_RECURSIVE)) {
                        $data[$tableName][$field] = implode(",", $val);
                    }

                    if (isset($this->fieldType[$field])) {
                        if (in_array($this->fieldType[$field]["type"], array("IMAGE", "FILE", "FILE_NEW", "FILE_MULTI"))) {
                            $uploadPath = $this->uploadFormImage($val);
                            if (empty($uploadPath)) {
                                if (isset($values[$encryptedFieldName . "_pdocrud_file_input"]) && !empty($values[$encryptedFieldName . "_pdocrud_file_input"]))
                                    $uploadPath = $values[$encryptedFieldName . "_pdocrud_file_input"];
                            }
                            $data[$tableName][$field] = $uploadPath;
                        }
                        else if($this->fieldType[$field]["type"] === "PASSWORD" && isset($this->fieldType[$field]["parameters"]["encryption"])){
                             $data[$tableName][$field] = $this->encryptPassword($this->fieldType[$field]["parameters"]["encryption"], $val);
                        }
                    }
                }
            }else if (strpos($field, 'pdocrudcaptcha') !== false) {
                $this->checkCaptchaField($val);
            }
        }
        return $data;
    }
    
    private function cleanInputData($val) {
        if (is_string($val) ) {
            $val = htmlspecialchars($val, ENT_NOQUOTES, 'UTF-8');
        }
        return $val;
    }

    private function validateField($field, $val, $values = array()) {
        if ($this->settings["phpvalidation"]) {
            $this->pdocrudvalidate = new PDOCrudPHPValidation();
            if (isset($this->fieldValidation[$field])) {
                $rules = array();
                foreach ($this->fieldValidation[$field] as $validations) {
                    $param = "";
                    if (isset($validations["data-match"])) {
                        $param = $values[substr($validations["data-match"], 1)];
                    }
                    $rules[] = $validations;
                }
                return $this->pdocrudvalidate->validateField($rules, $val, $param);
            }
        }
        return true;
    }

    private function checkCaptchaField($val) {
        $userInput = $val;
        if ((int) $_SESSION["pdocrudcaptcha" . $this->formId] != (int) $userInput) {
            $this->addError($this->getLangData("invalid_captcha"));
            $this->getResponse("invalid_captcha");
            die();
        }
    }

    private function getResponse($data) {
        $response = array(
            "message" => $this->message,
            "error" => $this->getErrors(),
            "data" => $data,
            "redirectionurl" => ""
        );
        if (isset($this->formRedirection))
            $response["redirectionurl"] = $this->formRedirection["redirectionURL"];

        $response = $this->handleCallback('after_operation', $response);
        if ($this->settings["submissionType"] === "ajax" && !$this->backOperation)
            echo json_encode($response);
        else {
            $_SESSION["error"] = $this->getErrors();
            $_SESSION["message"] = $this->message;
        }
        $this->backOperation = false;
    }

    private function uploadFormImage($val) {
        if (count($val) !== count($val, COUNT_RECURSIVE)) {
            $path = array();
            for ($loop = 0; $loop < count($val["name"]); $loop++) {
                $file["name"] = $val["name"][$loop];
                $file["size"] = $val["size"][$loop];
                $file["type"] = $val["type"][$loop];
                $file["tmp_name"] = $val["tmp_name"][$loop];
                $file["error"] = $val["error"][$loop];
                $path[] = $this->fileUpload($file, $this->settings["uploadFolder"]);
            }
            return implode(",", $path);
        } else if (isset($val['name']))
            return $this->fileUpload($val, $this->settings["uploadFolder"]);

        return "";
    }
    
    private function dbQuickView($data) {
        $data = $this->handleCallback('before_quick_view_data', $data);
        $form = $this->getViewForm($data);
        $form = $this->handleCallback('after_quick_view_data', $form);
        return $form;
    }
    
    private function dbRelatedTableView($data){
        if (isset($data["id"]))
            $this->pkVal = $data["id"];
        $pdoModelObj = $this->getPDOModelObj();
        $pdoModelObj->where($this->pk, $this->pkVal);
        $result = $pdoModelObj->select($this->tableName);
        if (!count($result)) {
            $this->addError($this->getLangData("Edit_Form_No_Data_Found"));
            exit();
        }
        if (isset($this->multiTableRelation))
            $result = $this->getRelatedTable("", $result);
        return $result;
    }

    private function dbOnePage($data) {
        $data = $this->handleCallback('before_onepage_data', $data);
        $this->settings["addbtn"] = false;
//        $this->btnActions["onepageview"] = $this->btnActions["view"];
//        $this->btnActions["onepageview"][3] = "onepageview";
//        unset($this->btnActions["view"]);
//        $this->btnActions["onepageedit"] = $this->btnActions["edit"];
//        $this->btnActions["onepageedit"][3] = "onepageedit";
//        unset($this->btnActions["edit"]);
          if (isset($data["action"]) && $data["action"] === "onepageedit")
            $form = $this->getEditForm($data);
        else if (isset($data["action"]) && $data["action"] === "onepageview")
            $form = $this->getViewForm($data);
        else
            $form = $this->getInsertForm();
        $this->crudCall = true;
        $crud = $this->dbCRUD($data);
        $this->crudCall = false;
        $crud = $this->handleCallback('after_onepage_data', $crud);
        return $this->pdocrudView->renderOnePage($form, $crud, $this->settings);
    }

    private function dbCRUD($data) {
        $data = $this->handleCallback('before_table_data', $data);
        $pdoModelObj = $this->getPDOModelObj();
        $pdoModelObj = $this->addWhereCondition($pdoModelObj, $data);
        $pdoModelObj = $this->addJoinCondtion($pdoModelObj, false);
        $modal = "";
        $cols = array();
        $pdoModelObj->columns = array(
            "count(*) as totalrecords"
        );
        $result = $pdoModelObj->select($this->tableName);
        $totalRecords = $result[0]["totalrecords"];
        $recordPerPage = $this->settings["recordsPerPage"];
        if (isset($this->crudCall) && $this->crudCall === false) {
            $this->settings["addbtn"] = false;
            $this->btnActions["onepageview"] = $this->btnActions["view"];
            unset($this->btnActions["view"]);
            $this->btnActions["onepageedit"] = $this->btnActions["edit"];
            unset($this->btnActions["edit"]);
        } else {
            $this->crudCall = true;
        }
        if (strtolower($recordPerPage) === "all" || $recordPerPage > $totalRecords)
            $recordPerPage = $totalRecords;

        $pagination = $this->pdocrudhelper->pagination($this->currentpage, $totalRecords, $recordPerPage, $this->settings["adjacents"], $this->langData);
        $this->setTableColumns($pdoModelObj);

        if ($totalRecords > 0) {
            $pdoModelObj = $this->addJoinCondtion($pdoModelObj, false);
            $pdoModelObj = $this->addWhereCondition($pdoModelObj, $data);
            $pdoModelObj = $this->addLimitOrderBy($pdoModelObj, $data, $recordPerPage);
            $result = $pdoModelObj->select($this->tableName);
            $result = $this->reorderColumn($result);
            $cols = array_keys($result[0]);
            $this->searchCols = $cols;
            $pk = $this->getPrimaryKey($this->tableName, $cols[0]);
            $cols = $this->getColumnNames($cols);
            $result = $this->formatTableData($result);
            $from = ($this->currentpage - 1) * $recordPerPage + 1;
            $to = $totalRecords > (($this->currentpage - 1) * $recordPerPage + $recordPerPage) ? ($this->currentpage - 1) * $recordPerPage + $recordPerPage : $totalRecords;
            $this->langData["dispaly_records_info"] = $this->langData["showing"] . " " . $from . " " . $this->langData["to"] . " " . $to . " " . $this->langData["of"] . " " . $totalRecords . " " . $this->langData["entries"];
            $this->settings["row_no"] = ($this->currentpage - 1) * $recordPerPage;
        } else {
            $cols = $pdoModelObj->columnNames($this->tableName);
            if (isset($this->columns))
                $cols = $this->columns;
            $pk = $this->getPrimaryKey($this->tableName, $cols[0]);
            $cols = $this->getColFromJoinTables($cols, $pdoModelObj);
            $this->searchCols = $cols;
            $cols = $this->getColumnNames($cols);
            $result = array();
            $this->langData["dispaly_records_info"] = "";
            $this->settings["row_no"] = 0;
        }
        $this->settings["back_operation"] = $this->backOperation;
        $this->backOperation = false;
        $result = $this->handleCallback('format_table_data', $result);
        $cols = $this->handleCallback('format_table_col', $cols);
        $this->setTableHeadings();
        $search = $this->getSearchBox($cols, $data);
        $filterbox = $this->generateFilterControls($data);
        $perPageRecords = $this->perPageRecords($totalRecords, $data);
        $extraData = $this->getExtraData();
        if (!isset($this->colsRemove))
            $this->colsRemove = array();
        if (isset($this->portfolioCol))
            $output = $this->pdocrudView->renderPortfolio($cols, $result, $pk, $this->objKey, $this->langData, $this->settings, $this->colsRemove, $this->btnActions, $this->portfolioCol);
        else
            $output = $this->pdocrudView->renderTable($cols, $result, $pk, $this->objKey, $this->langData, $this->settings, $this->colsRemove, $this->btnActions);
        if ($this->settings["inlineEditbtn"]) {
            $formtag = $this->getFormTag();
            $output = "<form " . $formtag . ">" . $output . "</form>";
        }

        if ($this->formPopup)
            $modal = $this->getMoodelContent($this->objKey . "_modal", "", "", "");
        $crud = $this->pdocrudView->renderCrud($output, $search, $pagination, $perPageRecords, $this->langData, $this->objKey, $modal, $this->settings, $extraData);
        $crud = $this->handleCallback('after_table_data', $crud);
        if (is_array($filterbox) && count($filterbox) && !isset($data["action"]))
            $crud = $this->pdocrudView->renderCrudFilter($filterbox, $crud, $this->langData, $this->objKey, $this->settings);

        return $crud;
    }

    private function dbSQL($data) {
        $this->setSettings("pagination", false);
        $this->setSettings("recordsPerPageDropdown", false);
        $this->setSettings("totalRecordsInfo", false);
        $data = $this->handleCallback('before_sql_data', $data);
        $pdoModelObj = $this->getPDOModelObj();
        $result = $pdoModelObj->executeQuery($this->sql, $data);
        $totalRecords = count($result);
        $recordPerPage = $this->settings["recordsPerPage"];
        if (strtolower($recordPerPage) === "all")
            $recordPerPage = $totalRecords;
        $pagination = $this->pdocrudhelper->pagination($this->currentpage, $totalRecords, $recordPerPage, $this->settings["adjacents"], $this->langData);

        if (isset($this->columns)) {
            $cols = $this->getColumnNames($this->columns);
        }

        if ($totalRecords > 0) {
            $cols = array_keys($result[0]);
            $cols = $this->getColumnNames($cols);
            $result = $this->formatTableData($result);
            $from = ($this->currentpage - 1) * $recordPerPage + 1;
            $to = $totalRecords > (($this->currentpage - 1) * $recordPerPage + $recordPerPage) ? ($this->currentpage - 1) * $recordPerPage + $recordPerPage : $totalRecords;
            $this->langData["dispaly_records_info"] = $this->langData["showing"] . " " . $from . " " . $this->langData["to"] . " " . $to . " " . $this->langData["of"] . " " . $totalRecords . " " . $this->langData["entries"];
        }

        $result = $this->handleCallback('format_sql_data', $result);
        $cols = $this->handleCallback('format_sql_col', $cols);
        $this->setTableHeadings();
        $search = $this->getSearchBox($cols, $data);
        $perPageRecords = $this->perPageRecords($totalRecords, $data);
        $output = $this->pdocrudView->renderSQL($cols, $result, $this->objKey, $this->langData, $this->settings, $pagination, $perPageRecords);
        $output = $this->handleCallback('after_sql_data', $output);
        return $output;
    }

    private function dbAdvSearch() {
        $advanceSearch = $this->getAdvSearchControls();
        return $this->pdocrudView->renderCrudAdvSearch($advanceSearch, $this->langData, $this->objKey, $this->settings);
    }

    private function setTableHeadings() {
        if (isset($this->tableHeading))
            $this->langData["tableHeading"] = $this->tableHeading;
        else
            $this->langData["tableHeading"] = str_replace("-", " ", ucfirst(str_replace("_", " ", $this->tableName)));

        $this->langData["tableSubHeading"] = "";
        if (isset($this->tableSubHeading))
            $this->langData["tableSubHeading"] = $this->tableSubHeading;
    }

    private function setTableColumns($pdoModelObj) {
        if (isset($this->columns)) {
            $pk = $this->getPrimaryKey($this->tableName);
            if (!in_array($pk, $this->columns)) {
                if (isset($this->joinTable) && count($this->joinTable) && is_array($this->joinTable)) {
                    array_unshift($this->columns, $this->tableName . "." . $pk);
                    array_unshift($this->colsRemove, $this->tableName . "." . $pk);
                } else {
                    array_unshift($this->columns, $pk);
                    array_unshift($this->colsRemove, $pk);
                }
            }
            $pdoModelObj->columns = $this->columns;
        }
        if (isset($this->relData)) {
            if(!isset($this->columns)){
                $pdoModelObj->columns  = $this->getPDOModelObj()->columnNames($this->tableName);
            }
            foreach ($this->relData as $relData) {
                $key = array_search($relData["mainTableCol"], $pdoModelObj->columns);
                $pdoModelObj->columns[$key] = $this->getRelatedColumn($relData);
            }
        }
    }
    
    private function getRelatedColumn($relData, $alias = true) {
        if (is_array($relData["relDisplayCol"]))
            $relData["relDisplayCol"] = sprintf("'%s'", implode("','", $relData["relDisplayCol"]));

        $subquery = "(SELECT GROUP_CONCAT(DISTINCT (CONCAT_WS('-', " . $relData["relDisplayCol"] . " )) SEPARATOR ', ') FROM `" . $relData["relTable"] . "` ";
        $subquery .= "WHERE FIND_IN_SET(`" . $relData["relTable"] . "`.`" . $relData["relTableCol"] . "`,`" . $this->tableName . "`.`" . $relData["mainTableCol"] . "`))";
        if ($alias)
            $subquery .= " as " . $relData["mainTableCol"];
        return $subquery;
    }

    private function addLimitOrderBy(PDOModel $pdoModelObj, $data = array(), $recordPerPage = 10) {
        $pdoModelObj->limit = $this->getSelectPageLimit($recordPerPage);
        if (isset($data["sortkey"])) {
            $fieldName = $this->decrypt($data["sortkey"]);
            $this->sortOrder[$fieldName] = $data["action"];
            $pdoModelObj->orderByCols = array(
                $fieldName . " " . $data["action"]
            );
        } else if (isset($this->orderByCols)) {
            $pdoModelObj->orderByCols = array(
                $this->orderByCols
            );
        } else if ($this->settings["dbtype"] === "sqlserver") {
            $pk = $this->getPrimaryKey($this->tableName);
            $pdoModelObj->orderByCols = array(
                $pk
            );
        }
        return $pdoModelObj;
    }

    private function getSelectPageLimit($recordPerPage) {
        $limit = 10;
        if (!isset($this->limit)) {
            $limit = ($this->currentpage - 1) * $recordPerPage . "," . $recordPerPage;
        } else {
            if ($this->limit > ($this->currentpage - 1) * $recordPerPage + $recordPerPage) {
                $limit = ($this->currentpage - 1) * $recordPerPage . "," . $recordPerPage;
            } else {
                $limit = ($this->currentpage - 1) * $recordPerPage . "," . $this->limit;
            }
        }
        return $limit;
    }

    private function addJoinCondtion(PDOModel $pdoModelObj, $showLeftJoinCol = false) {
        if (is_array($this->joinTable) && count($this->joinTable) > 0) {
            foreach ($this->joinTable as $join) {
                if (strtoupper($join["type"]) == "INNER JOIN")
                    $pdoModelObj->joinTables($join["table"], $join["condition"], $join["type"]);
                else if (strtoupper($join["type"]) == "LEFT JOIN" && $showLeftJoinCol)
                    $pdoModelObj->joinTables($join["table"], $join["condition"], $join["type"]);
            }
        }
        return $pdoModelObj;
    }

    private function getColumnNames($cols, $encrypt = true) {
        $columns = array();
        if (is_array($this->colAdd) && count($this->colAdd)) {
            $cols = array_merge($cols, array_keys($this->colAdd));
        }
        if (is_array($cols) && count($cols)) {
            foreach ($cols as $col) {
                $tooltip = "";
                $attr = "";
                $sort = "sort";
                $type = "text";

                if (isset($this->colAttr[$col])) {
                    foreach ($this->colAttr[$col] as $key => $val) {
                        if ($key === "width" || $key === "height") {
                            if (strpos($attr, 'style') !== false) {
                                $attr = substr($attr, 0, strlen($attr) - 1) . ";$key:$val\"";
                            } else {
                                $attr .= "style = \"$key:$val\"";
                            }
                        } else {
                            $attr .= "$key = \"$val\"";
                        }
                    }
                }

                if ($encrypt)
                    $key = $this->encrypt($col);
                else
                    $key = $col;

                if (isset($this->crudTooltip[$col]))
                    $tooltip = $this->getToolTipField($this->crudTooltip[$col]["tooltip"], $this->crudTooltip[$col]["tooltipIcon"]);
                if (isset($this->colNames[$col]))
                    $colname = $this->colNames[$col];
                else
                    $colname = str_replace("-", " ", ucfirst(str_replace("_", " ", $col)));

                if (isset($this->sortOrder[$col])) {
                    if ($this->sortOrder[$col] === "asc")
                        $sort = "desc";
                    else if ($this->sortOrder[$col] === "desc")
                        $sort = "asc";
                }

                if (isset($this->searchColDataType[$col])) {
                    $type = $this->searchColDataType[$col];
                }

                $columns[$key] = array(
                    "colname" => $colname,
                    "tooltip" => $tooltip,
                    "attr" => $attr,
                    "sort" => $sort,
                    "col" => $col,
                    "type" => $type
                );
            }
        }
        $this->sortOrder = array();
        return $columns;
    }

    private function crudTableColDataSource() {
        if (isset($this->tableColDatasource)) {
            $pdoModelObj = $this->getPDOModelObj();
            foreach ($this->tableColDatasource as $source) {
                if ($source["dataSource"] === "db") {
                    $pdoModelObj->columns = array($source["joinColName"], $source["dataCol"]);
                    $data = $pdoModelObj->select($source["tableName"]);
                } else if ($source["dataSource"] === "array") {
                    $data = $source["tableName"];
                }
                if (isset($data)) {
                    foreach ($data as $row) {
                        $replace = array($row[$source["joinColName"]] => $row[$source["dataCol"]]);
                        $this->tableColFormatting($source["colname"], "replace", array($row[$source["joinColName"]] => $row[$source["dataCol"]]));
                    }
                }
            }
        }
    }

    private function formatTableData($result) {
        $this->crudTableColDataSource();

        if (is_array($this->tableDataFormat) && count($this->tableDataFormat)) {
            $result = $this->pdoTableFormatObj->formatTableData($result, $this->tableDataFormat);
        }

        if (is_array($this->colFormat) && count($this->colFormat)) {
            $result = $this->pdoTableFormatObj->formatTableCol($result, $this->colFormat);
        }

        if (is_array($this->colAdd) && count($this->colAdd)) {
            $result = $this->pdoTableFormatObj->addTableCol($result, $this->colAdd);
        }

        if (is_array($this->colSumPerPage) && count($this->colSumPerPage)) {
            $result = $this->pdoTableFormatObj->addSumPerPage($result, $this->colSumPerPage);
        }

        if (is_array($this->colSumTotals) && count($this->colSumTotals)) {
            $result = $this->getColSum($result);
        }

        if (is_array($this->actions)  && count($this->actions)) {
            $result = $this->pdoTableFormatObj->addColSwitch($result, $this->actions, $this->pk);
        }

        if (is_array($this->bulkCrudUpdateCol) && count($this->bulkCrudUpdateCol)) {
            $this->bulkCrudUpdateCol = $this->handleCallback('before_bulk_update', $this->bulkCrudUpdateCol);
            foreach ($this->bulkCrudUpdateCol as $col => $param) {
                $data = array();
                $param["attr"] = array_merge($param["attr"], array("data-id" => "{pk-val}", "data-col" => $col, "data-orignal-val" => "{val}"));
                $data[$col] = array("field" => $this->getHTMLElement($col . "[]", $param["fieldType"], $param["attr"],  array("{val}"),  $param["fieldData"], array("input-bulk-crud-update")));
                $result = $this->pdoTableFormatObj->bulkUpdate($result, $data, $this->pk);
            }
        }

        return $result;
    }

    private function getAdvSearchControls() {
        $advSearch = array();
        $loop = 0;
        if (isset($this->advSearch)) {
            foreach ($this->advSearch as $col) {
                $htmlType = "select";
                $fieldData = array();

                if (isset($this->advSearchParam[$col]))
                    $htmlType = $this->advSearchParam[$col]["searchType"];

                $fieldName = $this->encrypt($this->tableName . $this->tableFieldJoin . $col);
                $attr = $this->getFieldAttributes($col);
                if (isset($this->advSearchParam[$col]))
                    $advSearch[$loop]["lable"] = $this->getLableField($this->advSearchParam[$col]["displayText"], $col);
                else
                    $advSearch[$loop]["lable"] = $this->getHTMLElementLable($col, $fieldName, $htmlType);

                if (isset($this->advSearchDataSource[$col]))
                    $fieldData = $this->getSearchFieldData($col);

                $advSearch[$loop]["element"] = $this->getHTMLElement($fieldName, $htmlType, $attr, array(), $fieldData, array("pdocrud-adv-search"));
                $loop++;
            }
            $advSearch[$loop]["lable"] = "";
            $attr = array("data-action" => "render_adv_search");
            $advSearch[$loop]["element"] = $this->getAnchorField($this->getLangData("search"), "javascript:;", $attr, array("pdocrud-adv-search-btn"));
        }
        return $advSearch;
    }

    private function getSearchFieldData($fieldName) {
        if (isset($this->advSearchDataSource[$fieldName])) {
            if ($this->advSearchDataSource[$fieldName]["bind"] === "db") {
                $pdoModelObj = $this->getPDOModelObj();
                $pdoModelObj->columns = array(
                    $this->advSearchDataSource[$fieldName]["key"],
                    $this->advSearchDataSource[$fieldName]["val"]
                );
                $data = $pdoModelObj->select($this->advSearchDataSource[$fieldName]["dataSource"]);
                return $data;
            } else {
                return $this->formatDatasource($this->advSearchDataSource[$fieldName]["dataSource"]);
            }
        }
    }

    private function getInsertForm() {
        $pdoModelObj = $this->getPDOModelObj();
        $this->pk = $this->getPrimaryKey($this->tableName);
        $fields = $pdoModelObj->tableFieldInfo($this->tableName);
        $fields = $this->getStaticFields($fields);
        $formTag = $this->getFormTag();
        $data = $this->getHTMLData($fields, $this->tableName);
        $data = $this->getJoinFormData($pdoModelObj, $data);
        $data = $this->getSortedData($data);
        $output = $this->renderFormData($data);
        $output = $this->handleCallback('before_insert_form', $output);
        $submitData = $this->getSubmitData("insert", $this->submitbtnClass);
        $this->langData["operation"] = $this->langData["add"];
        $form = $this->pdocrudView->renderForm($formTag, $output, $this->settings, $submitData, $this->langData);
        $this->leftJoin = "";
        if (isset($this->formPopup) && $this->directCall)
            $form = $this->getFormPopup($form);
        $form = $this->handleCallback('after_insert_form', $form);
        return $form;
    }

    private function getEditForm($data = array()) {
        if (isset($data["id"]))
            $this->pkVal = $data["id"];
        $pdoModelObj = $this->getPDOModelObj();
        $pdoModelObj->where($this->pk, $this->pkVal);
        $result = $pdoModelObj->select($this->tableName);
        if (!count($result)) {
            $this->addError($this->getLangData("Edit_Form_No_Data_Found"));
            exit();
        }
        $pdoModelObj->resetWhere();
        $fields = $pdoModelObj->tableFieldInfo($this->tableName);
        $fields = $this->getStaticFields($fields);
        $formTag = $this->getFormTag();
        $data = $this->getHTMLData($fields, $this->tableName, $result[0]);
        $data = $this->getJoinFormData($pdoModelObj, $data, $result, true);
        $data = $this->getSortedData($data);
        $submitType = "update";
        if ($this->inlineEdit)
            $submitType = "inline_edit";

        $submitData = $this->getSubmitData($submitType);
        if ($this->inlineEdit)
            return $this->pdocrudView->renderInlineField($data, $this->settings, $submitData);
        else
            $output = $this->renderFormData($data, $submitData);
        $output = $this->handleCallback('before_edit_form', $output);
        $this->langData["operation"] = $this->langData["edit"];
        $this->leftJoin = "";
        $form = $this->pdocrudView->renderForm($formTag, $output, $this->settings, $submitData, $this->langData);
        if (isset($this->formPopup) && $this->directCall)
            $form = $this->getFormPopup($form);
        if (isset($this->multiTableRelation))
            $form = $this->getRelatedTable($form, $result);
        if (isset($this->sidebar))
            $form = $this->getSidebarData($form, $result);
        $form = $this->handleCallback('after_edit_form', $form);
        return $form;
    }

    private function getViewForm($data) {
        if (isset($data["id"]))
            $this->pkVal = $data["id"];
        $pdoModelObj = $this->getPDOModelObj();
        $leftJoinData = array();
        if (isset($this->viewColumns)) {
            $pdoModelObj->columns = $this->viewColumns;
            $cols = $this->viewColumns;
        } else if (isset($this->columns)) {
            $pdoModelObj->columns = $this->columns;
            $cols = $this->columns;
        } else {
            $cols = $pdoModelObj->columnNames($this->tableName);
        }
        $pdoModelObj->where($this->tableName . "." . $this->pk, $this->pkVal);
        $pdoModelObj = $this->addJoinCondtion($pdoModelObj, false);
        $result = $queryData = $pdoModelObj->select($this->tableName);
        if (!count($result)) {
            $this->addError($this->getLangData("View_Form_No_Data_Found"));
            exit();
        }
        if (is_array($this->viewColFormat) && count($this->viewColFormat)) {
            $result = $this->pdoTableFormatObj->formatTableCol($result, $this->viewColFormat);
        }
        $result = $this->getViewHTMLData($result[0], $this->tableName);
        $result = $this->getSortedData($result);
        if ($this->settings["leftJoinData"])
            $leftJoinData = $this->getLeftJoinData();
        $columns = $this->getColumnNames($cols, false);
        $result = $this->handleCallback('before_view_form', $result);
        $output = $this->renderViewFormData($result, $columns, $leftJoinData, $data);
        if (isset($this->sidebar))
            $output = $this->getSidebarData($output, $queryData);
        $output = $this->handleCallback('before_view_form', $output);
        $output = $this->pdocrudView->renderViewForm($output, $this->settings, $this->objKey);
        if (isset($this->multiTableRelation) && isset($this->settings["viewFormTabs"]) && $this->settings["viewFormTabs"] === true)
            $output = $this->getRelatedTable($output, $queryData);
        $output = $this->handleCallback('after_view_form', $output);
        return $output;
    }

    private function getSelectForm() {
        $pdoModelObj = $this->getPDOModelObj();
        $this->pk = $this->getPrimaryKey($this->tableName);
        $fields = $pdoModelObj->tableFieldInfo($this->tableName);
        $fields = $this->getStaticFields($fields);
        $formTag = $this->getFormTag();
        $data = $this->getHTMLData($fields, $this->tableName);
        $data = $this->getJoinFormData($pdoModelObj, $data);
        $data = $this->getSortedData($data);
        $output = $this->renderFormData($data);
        $submitData = $this->getSubmitData("selectform", $this->submitbtnClass);
        $this->langData["operation"] = $this->langData["add"];
        $output = $this->handleCallback('before_select_form', $output);
        $form = $this->pdocrudView->renderForm($formTag, $output, $this->settings, $submitData, $this->langData);
        if (isset($this->formPopup) && $this->directCall)
            $form = $this->getFormPopup($form);
        $this->leftJoin = "";
        $form = $this->handleCallback('after_select_form', $form);
        return $form;
    }

    private function getEmailForm() {
        $pdoModelObj = $this->getPDOModelObj();
        $this->pk = $this->getPrimaryKey($this->tableName);
        $fields = $pdoModelObj->tableFieldInfo($this->tableName);
        $fields = $this->getStaticFields($fields);
        $formTag = $this->getFormTag();
        $data = $this->getHTMLData($fields, $this->tableName);
        $data = $this->getSortedData($data);
        $output = $this->renderFormData($data);
        $output = $this->handleCallback('before_email_form', $output);
        $submitData = $this->getSubmitData("email", $this->submitbtnClass);
        $form = $this->pdocrudView->renderForm($formTag, $output, $this->settings, $submitData, $this->langData);
        if (isset($this->formPopup))
            $form = $this->getFormPopup($form);
        $form = $this->handleCallback('after_email_form', $form);
        return $form;
    }
    
    private function getAutoSuggestData($data) {
        $pdoModelObj = $this->getPDOModelObj();
        $pdoModelObj->columns = array("DISTINCT(".$this->decrypt($data["search_col"]).")");
        if ($data["search_col"] !== "all") {
            $data["search_text"] = "%" . $data["search_text"] . "%";
            $pdoModelObj->where($this->decrypt($data["search_col"]), $data["search_text"], $this->searchOperator);
        }
        $result = $pdoModelObj->select($this->tableName);
        $output = array();
        foreach($result as $row){
            $val = $row[$this->decrypt($data["search_col"])];
            $output[] =  array("id"=>$val,"label"=>$val,"value"=>$val);
        }
        $json = json_encode($output);
        return $data["callback"]."(".$json.")";
    }

    private function getCloneForm($data = array()) {
        if (isset($data["id"]))
            $this->pkVal = $data["id"];
        $pdoModelObj = $this->getPDOModelObj();
        $pdoModelObj->where($this->pk, $this->pkVal);
        $result = $pdoModelObj->select($this->tableName);
        if (!count($result)) {
            $this->addError($this->getLangData("Edit_Form_No_Data_Found"));
            exit();
        }
        $pdoModelObj->resetWhere();
        $fields = $pdoModelObj->tableFieldInfo($this->tableName);
        $fields = $this->getStaticFields($fields);
        $formTag = $this->getFormTag();
        $data = $this->getHTMLData($fields, $this->tableName, $result[0]);
        $data = $this->getJoinFormData($pdoModelObj, $data, array(), true);
        $data = $this->getSortedData($data);
        $submitType = "insert";
        $submitData = $this->getSubmitData($submitType);
        $output = $this->renderFormData($data, $submitData);
        $this->langData["operation"] = $this->langData["insert"];
        $this->leftJoin = "";
        $form = $this->pdocrudView->renderForm($formTag, $output, $this->settings, $submitData, $this->langData);
        if (isset($this->formPopup) && $this->directCall)
            $form = $this->getFormPopup($form);
        if (isset($this->multiTableRelation))
            $form = $this->getRelatedTable($form, $result);
        if (isset($this->sidebar))
            $form = $this->getSidebarData($form, $result);
        return $form;
    }

    private function renderFormData($data, $submitData = array(), $type = "insert") {
        $this->submitbtnClass = "";
        if (isset($this->formSteps)) {
            $output = $this->getStepwiseFormData($data);
            $this->settings["formtype"] = "step";
            $this->submitbtnClass = "finish";
        } else if ($this->inlineEdit) {
            return $this->pdocrudView->renderInlineField($data, $this->settings, $submitData);
        } else {
            $output = $this->pdocrudView->renderField($data, $this->settings);
            $this->settings["formtype"] = "normal";
            $this->submitbtnClass = "";
        }

        if (isset($this->leftJoin))
            $output .= $this->leftJoin;

        return $output;
    }

    private function renderViewFormData($result, $columns, $leftJoinData, $data) {
        $this->submitbtnClass = "";
        if (isset($this->formSteps) && isset($this->settings["viewFormTabs"]) && $this->settings["viewFormTabs"] === true) {
            $viewData = array("columns" => $columns, "leftJoinData" => $leftJoinData, "data" => $data);
            $output = $this->getStepwiseFormData($result, $viewData);
            $this->settings["formtype"] = "step";
            $this->submitbtnClass = "finish";
        } else {
            $output = $this->pdocrudView->renderViewFields($result, $columns, $this->langData, $this->settings, $this->objKey, $leftJoinData, $data["id"]);
            $this->settings["formtype"] = "normal";
            $this->submitbtnClass = "";
        }

        return $output;
    }

    private function getLeftJoinData() {
        $data = array();
        $pdoModelObj = $this->getPDOModelObj();
        if (is_array($this->joinTable) && count($this->joinTable) > 0) {
            foreach ($this->joinTable as $join) {
                if ($join["type"] == "LEFT JOIN") {
                    $keyName = $this->getJoinKeyName($join["condition"]);
                    $pdoModelObj->where($keyName, $this->pkVal);
                    $data[$keyName] = $pdoModelObj->select($join["table"]);
                }
            }
        }
        return $data;
    }

    private function exportTableData($data) {
        $exportType = $data["exportType"];
        $pdoModelObj = $this->getPDOModelObj();
        if (isset($this->columns))
            $pdoModelObj->columns = $this->columns;
        if (isset($this->colsRemove) && count($this->colsRemove)) {
            if (isset($this->columns))
                $pdoModelObj->columns = array_diff($this->columns, $this->colsRemove);
            else {
                $cols = $pdoModelObj->columnNames($this->tableName);
                $pdoModelObj->columns = array_diff($cols, $this->colsRemove);
            }
        }
        if (isset($this->search))
            $pdoModelObj = $this->addWhereCondition($pdoModelObj, $this->search);
        $pdoModelObj = $this->addJoinCondtion($pdoModelObj, false);
        $this->setTableColumns($pdoModelObj);
        if (isset($this->tableName))
            $result = $pdoModelObj->select($this->tableName);
        else if (isset($this->sql))
            $result = $pdoModelObj->executeQuery($this->sql);
        if (is_array($result) && count($result)) {
            $colHeadings = array_map(function($v) {
                if (isset($this->exportColName[$v]))
                    return $this->exportColName[$v];
                return str_replace("-", " ", ucfirst(str_replace("_", " ", $v)));
                ;
            }, array_keys($result[0]));
            array_unshift($result, $colHeadings);
            switch ($exportType) {
                case "csv":
                    echo $this->arrayToCSV($result);
                    break;
                case "pdf":
                    echo $this->arrayToPDF($result);
                    break;
                case "excel":
                    echo $this->arrayToExcel($result);
                    break;
                case "xml":
                    echo $this->arrayToXML($result);
                    break;
                case "print":
                    $fileoutputmode = $this->fileOutputMode;
                    $this->fileOutputMode = "browser";
                    echo $this->arrayToHTML($result);
                    $this->fileOutputMode = $fileoutputmode;
                    break;
                default:
                    $this->addError($this->getLangData("error_export_option"));
            }
        }
    }

    private function getJoinFormData(PDOModel $pdoModelObj, $data, $result = array(), $edit = false) {
        if (is_array($this->joinTable) && count($this->joinTable) > 0) {
            foreach ($this->joinTable as $join) {
                if (strtoupper($join["type"]) === "LEFT JOIN") {
                    $fields = $pdoModelObj->tableFieldInfo($join["table"]);
                    if ($edit) {
                        $leftJoindata = array();
                        $keyName = $this->getJoinKeyName($join["condition"]);
                        $keyVal = $this->getJoinKeyValue($keyName, $result);
                        $pdoModelObj->where($keyName, $keyVal);
                        $joinData = $pdoModelObj->select($join["table"]);
                        foreach ($joinData as $joins) {
                            $leftJoindata[] = $this->getHTMLData($fields, $join["table"], $joins, true);
                        }
                        $this->leftJoin .= $this->pdocrudView->renderLeftJoin($leftJoindata, $this->settings, $this->langData);
                    } else {
                        $leftJoindata[] = $this->getHTMLData($fields, $join["table"], $result, true);
                        $this->leftJoin = $this->pdocrudView->renderLeftJoin($leftJoindata, $this->settings, $this->langData);
                    }
                } else if (strtoupper($join["type"]) === "INNER JOIN") {
                    if ($edit) {
                        $keyName = $this->getJoinKeyName($join["condition"]);
                        $keyVal = $this->getJoinKeyValue($keyName, $result);
                        $pdoModelObj->where($keyName, $keyVal);
                        $joinData = $pdoModelObj->select($join["table"]);
                        if ( is_array($joinData) && count($joinData))
                            $result = $joinData[0];
                    }
                    $fields = $pdoModelObj->tableFieldInfo($join["table"]);
                    $innerJoindata = $this->getHTMLData($fields, $join["table"], $result, false, true);
                    $data = array_merge_recursive($data, $innerJoindata);
                }
            }
        }
        return $data;
    }

    private function getStepwiseFormData($data, $viewData = array()) {
        $this->buttonHide("cancel");
        if ($this->formSteps[0]["stepType"] === "stepy")
            return $this->getStepyData($data, $viewData);
        else
            return $this->getTabStepData($data, $viewData);
    }

    private function getTabStepData($data, $viewData) {
        $stepHeader = "";
        $stepBody = "";
        $stepstart = "<div id=\"tabs\" class=\"pdocrud_tabs\"><ul class=\"stepy-titles clearfix\">";
        $stepend = "</ul>";
        $stepbodystart = "<div>";
        $stepbodyend = "</div>";

        foreach ($this->formSteps as $step) {
            $stepHeader .= $this->getStepHeader($step["stepId"], $step["stepName"]);
            $stepFields = $step["fields"];
            $content = array();
            if (isset($stepFields)) {
                foreach ($stepFields as $stepField) {
                    foreach ($data as $key => $val) {
                        if ($val['fieldName'] === $stepField) {
                            $content[] = $data[$key];
                            break;
                        }
                    }
                }
                if (is_array($viewData) && count($viewData))
                    $stepBody .= "<div id=" . $step["stepId"] . ">" . $this->pdocrudView->renderViewFields($content, $viewData["columns"], $this->langData, $this->settings, $this->objKey, $viewData["leftJoinData"], $viewData["data"]["id"]) . "</div>";
                else
                    $stepBody .= "<div id=" . $step["stepId"] . ">" . $this->pdocrudView->renderField($content, $this->settings) . "</div>";
            }
        }
        $output = $stepstart . $stepHeader . $stepend . $stepBody . "</div>";
        return $output;
    }

    private function getStepyData($data, $viewData) {
        $stepHeader = "";
        $stepBody = "";
        $stepstart = "<div class=\"stepy-tab\"><ul class=\"stepy-titles clearfix\">";
        $stepend = "</ul></div>";
        $stepbodystart = "<div>";
        $stepbodyend = "</div>";

        foreach ($this->formSteps as $step) {
            $stepHeader .= $this->getStepHeader($step["stepId"], $step["stepName"], "stepy");
            $stepFields = $step["fields"];
            $content = array();
            if (isset($stepFields)) {
                foreach ($stepFields as $stepField) {
                    foreach ($data as $key => $val) {
                        if ($val['fieldName'] === $stepField) {
                            $content[] = $data[$key];
                            break;
                        }
                    }
                }
                if (is_array($viewData) && count($viewData))
                    $stepBody .= "<fieldset title=\"" . $step["stepName"] . "\" class=\"step\" id=\"" . $step["stepId"] . "\"><legend> </legend>" . $this->pdocrudView->renderViewFields($content, $viewData["columns"], $this->langData, $this->settings, $this->objKey, $viewData["leftJoinData"], $viewData["data"]["id"]) . "</fieldset>";
                else
                    $stepBody .= "<fieldset title=\"" . $step["stepName"] . "\" class=\"step\" id=\"" . $step["stepId"] . "\"><legend> </legend>" . $this->pdocrudView->renderField($content, $this->settings) . "</fieldset>";
            }
        }
        $output = $stepstart . $stepHeader . $stepend . $stepBody;
        return $output;
    }

    private function getColSum($data) {
        $pdoModelObj = $this->getPDOModelObj();
        $colsum = array();
        foreach ($this->colSumTotals as $cols) {
            $colsum[] = "SUM(" . $cols . ") as " . $cols;
        }
        $pdoModelObj->columns = $colsum;
        if (isset($this->search))
            $pdoModelObj = $this->addWhereCondition($pdoModelObj, $this->search);
        $pdoModelObj = $this->addJoinCondtion($pdoModelObj, false);
        $sumresult = $pdoModelObj->select($this->tableName);
        $count = count($data);
        foreach ($data as $rows) {
            foreach ($rows as $col => $row) {
                $data[$count][$col] = "";
                if (isset($sumresult[0][$col]))
                    $data[$count][$col] = array("content" => $sumresult[0][$col], "sum_type" => "grand_sum");
            }
            break;
        }

        return $data;
    }

    private function getSortedData($data) {
        usort($data, function($a, $b) {
            return $a['order'] - $b['order'];
        });
        return $data;
    }
    
    private function getExtraData(){
        $extraData = array();
        if(isset($this->btnTopAction))
            $extraData["btnTopAction"] = $this->btnTopAction;
        if(isset($this->dateRangeReport))
            $extraData["dateRangeReport"] = $this->dateRangeReport;
        return $extraData;
    }
    
    private function getDateRangeFromDate($type) {
        switch (strtolower($type)) {
            case "calendar_year": return date('Y-01-01');
                break;
            case "calendar_month": return date('Y-m-01');
                break;
            case "year": $time = strtotime("-365 days", time());
                return date("Y-m-d", $time);
                break;
            case "month": $time = strtotime("-30 days", time());
                return date("Y-m-d", $time);
                break;
            case "week" : $time = strtotime("-1 week", time());
                return date("Y-m-d", $time);
                break;
            case "oneday": $time = strtotime("-1 day", time());
                return date("Y-m-d", $time);
            case "today": return date("Y-m-d 00:00:00");    
                break;
        }
        return date("Y-m-d");
    }

    private function exportFormData($data) {
        $exportType = $data["exportType"];
        $formData = $this->formatFormData($data["post"]);
        $formData = $formData["data"];
        if ($exportType === "xml")
            $exportData = array(
                $formData
            );
        else
            $exportData = array(
                array_keys($formData),
                $formData
            );

        switch ($exportType) {
            case "csv":
                echo $this->arrayToCSV($exportData);
                break;
            case "pdf":
                echo $this->arrayToPDF($exportData);
                break;
            case "excel":
                echo $this->arrayToExcel($exportData);
                break;
            case "xml":
                echo $this->arrayToXML($exportData);
                break;
            default:
                $this->addError($this->getLangData("error_export_option"));
        }
    }

    private function getPrimaryKey($tableName, $cols = array()) {
        if (!isset($this->pk)) {
            $pdoModelObj = $this->getPDOModelObj();
            $this->pk = $pdoModelObj->primaryKey($this->tableName);
            if (empty($this->pk) && isset($cols[0]))
                $this->pk = $cols[0];
        }
        return $this->pk;
    }

    private function getColFromJoinTables($cols, $pdoModelObj) {
        if (is_array($this->joinTable) && count($this->joinTable) > 0) {
            foreach ($this->joinTable as $join) {
                if (strtoupper($join["type"]) !== "LEFT JOIN") {
                    $cols = array_merge($cols, $pdoModelObj->columnNames($join["table"]));
                }
            }
        }
        return $cols;
    }

    private function getJoinKeyName($joinCondition) {
        $joinCon = explode("=", $joinCondition);
        if (strpos($joinCon[0], $this->tableName))
            $joinCol = explode(".", $joinCon[1]);
        else
            $joinCol = explode(".", $joinCon[0]);
        return trim($joinCol[1]);
    }
    
    private function getJoinKeyValue($keyName, $result){
        $val = $this->pkVal;
        if(count($result)){
            foreach($result as $row){
               if(isset($row[$keyName])){
                   return $row[$keyName];
               }
            }
        }
        return $val;
    }

    private function getStaticFields($fields) {
        if (isset($this->fieldsStatic))
            $fields = array_merge($fields, $this->fieldsStatic);
        if (isset($this->formCaptcha))
            $fields = array_merge($fields, $this->formCaptcha);
        return $fields;
    }

    private function getFormTag($inlineform = false) {
        $form = "data-toggle=\"validator\" data-disable=\"false\"  method=\"post\" enctype=\"multipart/form-data\" ";
        $class = "pdocrud-form";

        if (!isset($this->formId))
            $this->formId = $this->getRandomKey(false);

        if (is_array($this->form["class"]) && count($this->form["class"])) {
            $class .= implode(" ", $this->form["class"]);
        }

        if (isset($this->form["formType"]) && !empty($this->form["formType"]) && !$inlineform) {
            if (strtolower($this->form["formType"]) === "inline")
                $class .= " form-inline";
            else if (strtolower($this->form["formType"]) === "horizontal")
                $class .= " form-horizontal";
        }

        if (is_array($this->form["attr"]) && count($this->form["attr"])) {
            $form .= implode(', ', array_map(function($v, $k) {
                        return $k . '=' . $v;
                    }, $this->form["attr"], array_keys($this->form["attr"])));
        }
        $form .= " id =\"$this->formId\"";
        $form .= " class = \"$class\"";
        return $form;
    }

    private function getHTMLData($fields, $table, $result = array(), $leftJoin = false, $innerJoin = false) {
        $data = array();
        $loop = 0;
        if (is_array($fields) && count($fields)) {
            $fields = $this->getFormFields($fields);
            foreach ($fields as $field) {
                $val = array();
                $fieldExtra = $field["Extra"];
                $fieldName = $field["Field"];
                $fieldType = $field["Type"];
                $blockclass = "blockClass";

                if ($this->isAutoIncrementField($fieldExtra))
                    continue;

                if ($leftJoin || $innerJoin) {
                    if ($this->checkJoinKeyField($fieldName, $table))
                        continue;
                }

                if ($fieldExtra === "static")
                    $encryptedFieldName = "pdocrud" . $this->encrypt($fieldName);
                else if ($fieldExtra === "captcha")
                    $encryptedFieldName = "pdocrudcaptcha" . $this->encrypt($fieldName);
                else if ($fieldExtra === "db"){
                    $encryptedFieldName = "pdocruddb_" .$this->encrypt($table . $this->tableFieldJoin . $field["DbField"]);
                }
                else
                    $encryptedFieldName = $this->encrypt($table . $this->tableFieldJoin . $fieldName);

                if (isset($result[$fieldName]))
                    $val[0] = $result[$fieldName];
                else if (isset($this->formFieldVal[$fieldName]))
                    $val[0] = $this->formFieldVal[$fieldName];

                if (strtolower($this->form["formType"]) === "horizontal")
                    $blockclass = "horizontalblockClass";

                if ($leftJoin)
                    $encryptedFieldName = $encryptedFieldName . "[]";

                $attr = $this->getFieldAttributes($fieldName);
                $fieldClass = $this->getFieldClass($fieldName);
                $htmlType = $this->getHTMLElementType($fieldName, $fieldType);
                $fieldData = $this->getFieldData($fieldName);
                $data[$loop]["lable"] = $this->getHTMLElementLable($fieldName, $encryptedFieldName, $htmlType);
                if (strtolower($htmlType) === "hidden") {
                    $data[$loop]["lable"] = "";
                }
                if (in_array(strtolower($htmlType), array("hidden", "inputtext", "textarea")) && !isset($result[$fieldName]) && is_array($fieldData)) {
                    if (isset($fieldData[0][1]))
                        $val[0] = $fieldData[0][1];
                }
                $data[$loop]["fieldName"] = $fieldName;
                $data[$loop]["element"] = $this->getHTMLElement($encryptedFieldName, $htmlType, $attr, $val, $fieldData, $fieldClass);
                $data[$loop][$blockclass] = $this->getHTMLElementBlockClass($fieldName);
                $data[$loop]["group"] = $this->getHTMLElementGroup($fieldName);
                $data[$loop]["tooltip"] = $this->getHTMLElementTooltip($fieldName);
                $data[$loop]["desc"] = $this->getHTMLElementDesc($fieldName);
                $data[$loop]["addOnBefore"] = $this->getHTMLElementAddOn($fieldName, "before");
                $data[$loop]["addOnAfter"] = $this->getHTMLElementAddOn($fieldName, "after");
                $data[$loop]["order"] = $this->getHTMLElementFieldOrder($fieldName);
                $loop++;
            }
        }
        return $data;
    }

    private function getViewHTMLData($result, $table) {
        $data = array();
        $loop = 0;
        foreach ($result as $fieldName => $val) {
            $htmlType = "void";
            $blockclass = "blockClass";
            $encryptedFieldName = $this->encrypt($table . $this->tableFieldJoin . $fieldName);
            if (strtolower($this->form["formType"]) === "horizontal") {
                $blockclass = "horizontalblockClass";
            }
            if (isset($this->fieldType[$fieldName])) {
                $htmlType = $this->fieldType[$fieldName]["type"];
            }
            if (strtolower($htmlType) === "hidden") {
                $data[$loop]["lable"] = "";
            }

            $attr = $this->getFieldAttributes($fieldName);
            $fieldClass = $this->getFieldClass($fieldName);
            $fieldData = $this->getFieldData($fieldName);
            $data[$loop]["lable"] = $this->getHTMLElementLable($fieldName, $encryptedFieldName, $htmlType);
            $data[$loop]["fieldName"] = $fieldName;
            $data[$loop]["element"] = $val;
            $data[$loop][$blockclass] = $this->getHTMLElementBlockClass($fieldName);
            $data[$loop]["group"] = $this->getHTMLElementGroup($fieldName);
            $data[$loop]["tooltip"] = $this->getHTMLElementTooltip($fieldName);
            $data[$loop]["desc"] = $this->getHTMLElementDesc($fieldName);
            $data[$loop]["addOnBefore"] = $this->getHTMLElementAddOn($fieldName, "before");
            $data[$loop]["addOnAfter"] = $this->getHTMLElementAddOn($fieldName, "after");
            $data[$loop]["order"] = $this->getHTMLElementFieldOrder($fieldName);
            $loop++;
        }
        return $data;
    }

    private function checkJoinKeyField($fieldName, $tableName) {
        foreach ($this->joinTable as $join) {
            $condition = $join["condition"];
            $key = $tableName . "." . $fieldName;
            if (strpos($condition, $key) !== false) {
                return true;
            }
        }
        return false;
    }
    
    private function getJoinColFullName($colName) {
        foreach ($this->joinTable as $join) {
            $condition = $join["condition"];
            $joindata = explode("=",$condition);
            if (strpos($joindata[1], $colName) !== false) {
                return trim($joindata[1]);
            }else if (strpos($joindata[0], $colName) !== false) {
                return trim($joindata[0]);
            }
        }
        return $colName;
    }

    private function getFormFields($fields) {
        $formFields = array();
        
        if( isset($this->op) && $this->op === "EDITFORM" && isset($this->editFields)){
            foreach ($fields as $field) {
                if (in_array($field["Field"], $this->editFields))
                    $formFields[] = $field;
                else if (isset($field["Extra"]) && in_array($field["Extra"], array("static","db")))
                    $formFields[] = $field;
            }
            return $formFields;
        }
        
        if (isset($this->fields)) {
            foreach ($fields as $field) {
                if (in_array($field["Field"], $this->fields))
                    $formFields[] = $field;
                else if (isset($field["Extra"]) && in_array($field["Extra"], array("static","db")))
                    $formFields[] = $field;
            }
            $fields =  $formFields;
        } else if (isset($this->fieldsRemove)) {
            foreach ($fields as $field) {
                if (!in_array($field["Field"], $this->fieldsRemove))
                    $formFields[] = $field;
            }
            $fields = $formFields;
        }
        
        return $fields;
    }

    private function isAutoIncrementField($fieldExtra) {
        if (isset($fieldExtra) && ($fieldExtra === "auto_increment") && ($this->settings["hideAutoIncrement"])) {
            return true;
        }
        return false;
    }

    private function getFieldAttributes($fieldName) {
        $attr = array();

        if (isset($this->fieldAttr[$fieldName])) {
            foreach ($this->fieldAttr[$fieldName] as $fieldAttr) {
                $attr = array_merge($attr, $fieldAttr);
            }
        }

        if (isset($this->fieldDepend[$fieldName]))
            $attr = array_merge($attr, array(
                "data-dependent" => $this->encrypt($this->tableName . $this->tableFieldJoin . $this->fieldDepend[$fieldName]["dependOn"])
            ));

        if (isset($this->fieldValidation[$fieldName])) {
            foreach ($this->fieldValidation[$fieldName] as $validation) {
                $attr = array_merge($attr, $validation);
            }
        }

        if (isset($this->fieldConditionalLogic[strtolower($fieldName)])) {
            foreach ($this->fieldConditionalLogic[strtolower($fieldName)] as $key => $condition) {
                $condition["field"] = $this->encrypt($this->tableName . $this->tableFieldJoin . $condition["field"]);
                $data[] = $condition;
            }
            $attr = array_merge($attr, array(
                "data-condition-logic" => htmlspecialchars(json_encode($data))
            ));
        }

        if ($this->settings["required"] && !isset($this->fieldNotRequired[$fieldName]))
            $attr = array_merge($attr, array(
                "required" => true
            ));
        
        if (isset($this->settings["placeholder"]) && $this->settings["placeholder"])
            $attr = array_merge($attr, array(
                "placeholder" => $this->getPlaceholder($fieldName)
            ));

        return $attr;
    }
    
    private function getPlaceholder($fieldName){
        return  str_replace("-", " ", ucfirst(str_replace("_", " ", $fieldName)));
    }

    private function getFieldClass($fieldName) {
        if (isset($this->fieldClass[$fieldName])) {
            return $this->fieldClass[$fieldName];
        }
        return array();
    }

    private function getFieldData($fieldName) {
        if (isset($this->fieldDataBind[$fieldName])) {
            if ($this->fieldDataBind[$fieldName]["bind"] === "db") {
                $pdoModelObj = $this->getPDOModelObj();
                if (is_array($this->fieldDataBind[$fieldName]["val"])) {
                    $valColumn = "CONCAT_WS('".$this->fieldDataBind[$fieldName]["separator"]."',".implode(",",$this->fieldDataBind[$fieldName]["val"]).")";
                    $pdoModelObj->columns = array(
                        $this->fieldDataBind[$fieldName]["key"],
                        $valColumn
                    );
                } else {
                    $pdoModelObj->columns = array(
                        $this->fieldDataBind[$fieldName]["key"],
                        $this->fieldDataBind[$fieldName]["val"]
                    );
                }
                //apply where condition
                if (is_array($this->fieldDataBind[$fieldName]["where"]) && count($this->fieldDataBind[$fieldName]["where"]) > 0) {
                    foreach($this->fieldDataBind[$fieldName]["where"] as $where){
                        if(isset($where[0]) && isset($where[1]) && isset($where[2]))
                            $pdoModelObj->where($where[0], $where[1], $where[2]);
                    }
                }
                //apply order by condition
                if (is_array($this->fieldDataBind[$fieldName]["orderby"]) && count($this->fieldDataBind[$fieldName]["orderby"]) > 0) {
                    $orderByCols = implode($this->fieldDataBind[$fieldName]["orderby"], ",");
                    $pdoModelObj->orderByCols = array($orderByCols);
                }

                $data = $pdoModelObj->select($this->fieldDataBind[$fieldName]["tableName"]);
                return $data;
            } else {
                return $this->fieldDataBind[$fieldName]["dataSource"];
            }
        }
    }

    private function generateFilterControls() {
        $filterBox = array();
        if (isset($this->crudFilter)) {
            foreach ($this->crudFilter as $key => $filter) {
                $fieldData = array();
                $ds = $this->crudFilterSource[$key];

                if (isset($ds)) {
                    if ($ds["bind"] === "db") {
                        $pdoModelObj = $this->getPDOModelObj();
                        $pdoModelObj->backtick = "";
                        $pdoModelObj->columns = array(
                            " distinct (" . $ds["key"] . ")",
                            $ds["val"]
                        );

                        $fieldData = $pdoModelObj->select($ds["dataSource"]);
                    } else if ($ds["bind"] === "array") {
                        $dataSource = $this->formatDatasource($ds["dataSource"]);
                        $fieldData = $dataSource;
                    }
                }

                $fieldName = trim(str_replace(" ", "_", $key));
                $data = array();
                $attr = array("data-key" => $key, "data-action" => "filter");
                $fieldClass = array("pdocrud-filter");

                if ($filter["filterType"] === "dropdown")
                    $filterControl = $this->getSelectField($fieldName, $attr, $data, $fieldData, $fieldClass);
                else if ($filter["filterType"] === "radio")
                    $filterControl = $this->getRadioButtonField($fieldName, $attr, $data, $fieldData, $fieldClass);
                else if ($filter["filterType"] === "text")
                    $filterControl = $this->getInputField($fieldName, $attr, $data, "text", $fieldClass);

                $filterBox[$key] = $this->pdocrudView->renderFilter($filterControl, $filter["displayText"], $this->settings);
            }
        }
        return $filterBox;
    }

    private function getFilterControls($selectedData = array()) {
        $filterBox = array();
        $data = array();
        if (is_array($selectedData) && count($selectedData) && isset($selectedData["filter_val"]))
            $data = array($selectedData["filter_val"]);
        if (isset($this->crudFilter)) {
            foreach ($this->crudFilter as $key => $filter) {
                if ($filter["bind"] === "db") {
                    $pdoModelObj = $this->getPDOModelObj();
                    $pdoModelObj->columns = array(
                        $filter["key"],
                        $filter["val"]
                    );

                    $fieldData = $pdoModelObj->select($filter["tableName"]);
                    if (is_array($fieldData))
                        array_unshift($fieldData, array("key" => -1, "value" => $this->langData["select"] . " " . $filter["fieldName"]));
                } else {
                    $fieldData = $filter["dataSource"];
                }
                $fieldName = $this->encrypt($filter["tableName"] . $this->tableFieldJoin . $filter["fieldName"]);
                if (is_array($fieldData))
                    $filterBox[] = $this->getSelectField($fieldName, array("data-unique-id" => $key, "data-action" => "filter"), $data, $fieldData, array("pdocrud-filter"));
            }
        }
        return $filterBox;
    }
    
    private function reorderColumn($results) {
        if (isset($this->colOrder) && is_array($this->colOrder) && count($this->colOrder) > 0) {
            $data = array();
            foreach ($results as $k => $v)
                $data[] = array_merge(array_flip($this->colOrder), $v);
            $results = $data;
        }
        return $results;
    }

    private function getHTMLElementType($fieldName, $fieldType) {

        if (isset($this->fieldType[$fieldName])) {
            return $this->fieldType[$fieldName]["type"];
        }

        if ((strpos($fieldName, 'name') !== false || strpos($fieldName, 'title') !== false)) {
            return "INPUTTEXT";
        } else if ((strpos($fieldName, 'address') !== false || strpos($fieldName, 'message') !== false || strpos($fieldName, 'desc') !== false || strpos($fieldName, 'content') !== false)) {
            return "TEXTAREA";
        } else if ((strpos($fieldName, 'password') !== false) || (strpos($fieldName, 'pass') !== false)) {
            return "PASSWORD";
        } else if (strpos($fieldName, 'email') !== false) {
            return "EMAIL";
        }
        $fieldTypeVal = $fieldType;
        if (strpos($fieldType, '(') !== false) {
            $fieldTypeVal = substr($fieldType, 0, strpos($fieldType, '('));
        }
        switch (strtolower($fieldTypeVal)) {
            case "int":
                return "NUMERIC";
            case "varchar":
                return "INPUTTEXT";
            case "text":
                return "TEXTAREA";
            case "date":
                return "DATE";
            case "datetime":
                return "DATETIME";
            case "timestamp":
                return "NUMERIC";
            case "time":
                return "TIME";
            case "enum":
                if(isset($this->settings["enumToSelect"]) && $this->settings["enumToSelect"]){
                $enumValue = substr($fieldType, strpos($fieldType, '(') + 1, strpos($fieldType, ')')-(strpos($fieldType, '(') + 1));
                $enumValue = str_replace("'", "", $enumValue);
                $enumData = explode(",", $enumValue);
                $enumData = array_combine($enumData, $enumData);
                $this->fieldDataBinding($fieldName, $enumData, "", "", "array");
                }
                return "SELECT";
            case "set":
                 if(isset($this->settings["setToSelect"]) && $this->settings["setToSelect"]){
                $setValue = substr($fieldType, strpos($fieldType, '(') + 1, strpos($fieldType, ')')-(strpos($fieldType, '(') + 1));
                $setValue = str_replace("'", "", $setValue);
                $setData = explode(",", $setValue);
                $setData = array_combine($setData, $setData);
                $this->fieldDataBinding($fieldName, $setData, "", "", "array");
                }
                return "MULTISELECT";
            case "tinyint":
                return "NUMERIC";
            case "smallint":
                return "NUMERIC";
            case "bigint":
                return "NUMERIC";
            case "float":
                return "NUMERIC";
            case "double":
                return "NUMERIC";
            case "boolean":
                return "INPUTTEXT";
            case "char":
                return "INPUTTEXT";
            case "longtext":
                return "TEXTAREA";
            case "tinytext":
                return "INPUTTEXT";
            case "mediumtext":
                return "TEXTAREA";
            case "label":
                return "LABEL";
            case "html":
                return "HTML";
            case "checkbox":
                return "CHECKBOX";
            case "captcha":
                return "CAPTCHA";
            case "hidden":
                return "HIDDEN";
            case "textarea":
                return "TEXTAREA";
            case "select":
                return "SELECT";
            case "radio":
                return "RADIO";
            case "password":
                return "PASSWORD";
            case "multiselect":
                return "MULTISELECT";
            case "image":
                return "IMAGE";
            case "file":
                return "FILE";
            case "label":
                return "LABEL";
            case "email":
                return "EMAIL";
            case "submit":
                return "SUBMIT";
            case "url":
                return "URL";
            case "tel":
                return "TEL";
            case "googlemap":
                return "GOOGLEMAP";
            case "list":
                return "LIST";
            case "date":
                return "DATE";
            case "datetime":
                return "DATETIME";
            case "time":
                return "TIME";
            case "slider":
                return "SLIDER";
            case "void":
                return "VOID";
            default:
                return "INPUTTEXT";
        }
        return "INPUTTEXT";
    }

    private function getHTMLElement($fieldName, $htmlType, $attr = array(), $data = array(), $fieldData = array(), $fieldClass = array(), $fieldId = "") {
        $htmlType = preg_replace("/\([^)]+\)/", "", $htmlType);
        switch (strtoupper($htmlType)) {
            case "INPUTTEXT":
                return $this->getInputField($fieldName, $attr, $data, "text", $fieldClass, $fieldId);
            case "VARCHAR":
                return $this->getInputField($fieldName, $attr, $data, "text", $fieldClass, $fieldId);
            case "NUMERIC":
                return $this->getInputField($fieldName, $attr, $data, "number", $fieldClass, $fieldId);
            case "HIDDEN":
                return $this->getInputField($fieldName, $attr, $data, "hidden", $fieldClass, $fieldId);
            case "TEXTAREA":
                return $this->getTextareaField($fieldName, $attr, $data, $fieldClass);
            case "SELECT":
                return $this->getSelectField($fieldName, $attr, $data, $fieldData, $fieldClass);
            case "EMAIL":
                return $this->getInputField($fieldName, $attr, $data, "email", $fieldClass, $fieldId);
            case "SUBMIT":
                return $this->getInputField($fieldName, $attr, $data, "submit", $fieldClass);
            case "URL":
                return $this->getInputField($fieldName, $attr, $data, "url", $fieldClass, $fieldId);
            case "SEARCH":
                return $this->getInputField($fieldName, $attr, $data, "search", $fieldClass);
            case "TEL":
                return $this->getInputField($fieldName, $attr, $data, "tel", $fieldClass);
            case "RANGE":
                return $this->getInputField($fieldName, $attr, $data, "range", $fieldClass, $fieldId);
            case "RATEIT":
                $params = array("data-rateit-backingfld" => "#".$fieldName, "class" => "rateit");
                $rateit = $this->getDiv("rate_" . $fieldName, $params);
                return $this->getInputField($fieldName, $attr, $data, "rateit", $fieldClass) . $rateit;
            case "PASSWORD":
                return $this->getInputField($fieldName, $attr, $data, "password", $fieldClass);
            case "IMAGE":
                return $this->getInputField($fieldName, $attr, $data, "file", $fieldClass, $fieldId);
            case "FILE":
                return $this->getInputField($fieldName, $attr, $data, "file", $fieldClass, $fieldId);
            case "FILE_NEW":
                return $this->getFileUploadField($fieldName, $attr, $data, "file", $fieldClass, $fieldId);
            case "FILE_MULTI":
                $fieldName = $fieldName . "[]";
                $attr = array_merge($attr, array(
                    "multiple" => "multiple"
                ));
                return $this->getInputField($fieldName, $attr, $data, "file", $fieldClass);
            case "IMAGE_PREVIEW":
                return $this->getImagePreviewField($fieldName, $attr, $data, "file", $fieldClass);
            case "GOOGLEMAP":
                return $this->getGoogleMap($fieldName, $attr, $data, $fieldClass);
            case "RADIO":
                return $this->getRadioButtonField($fieldName, $attr, $data, $fieldData, $fieldClass);
            case "CHECKBOX":
                $fieldName = $fieldName . "[]";
                return $this->getCheckboxField($fieldName, $attr, $data, $fieldData, $fieldClass);
            case "CAPTCHA":
                return $this->getCaptcha($fieldName);
            case "HTML":
                return $this->getHTMLContent($fieldData);
            case "LABEL":
                return $this->getLableField($fieldData, $fieldName, $fieldClass);
            case "LIST":
                return $this->getListElements($fieldData, $attr);
            case "MULTISELECT":
                $fieldName = $fieldName . "[]";
                $attr = array_merge($attr, array(
                    "multiple" => "multiple"
                ));
                return $this->getSelectField($fieldName, $attr, $data, $fieldData);
            case "DATE":
                $fieldClass = array_merge($fieldClass, array(
                    "pdocrud-date"
                ));
                $attr = array_merge($attr, array(
                    "data-type" => "date"
                ));
                return $this->getInputField($fieldName, $attr, $data, "text", $fieldClass, $fieldId);
            case "DATETIME":
                $fieldClass = array_merge($fieldClass, array(
                    "pdocrud-datetime"
                ));
                $attr = array_merge($attr, array(
                    "data-type" => "datetime"
                ));
                return $this->getInputField($fieldName, $attr, $data, "text", $fieldClass, $fieldId);
            case "TIME":
                $fieldClass = array_merge($fieldClass, array(
                    "pdocrud-time"
                ));
                $attr = array_merge($attr, array(
                    "data-type" => "time"
                ));
                return $this->getInputField($fieldName, $attr, $data, "text", $fieldClass);
            case "SLIDER":
                $slider = $this->getSlider($attr, $fieldClass);
                return $slider . $this->getInputField($fieldName, $attr, $data, "hidden", $fieldClass);
            case "TAGS":
                $fieldClass = array_merge($fieldClass, array(
                    "pdocrud-input-tags"
                ));
                return $this->getInputField($fieldName, $attr, $data, "text", $fieldClass);
            case "VOID": return $fieldName;
            default:
                return $this->getInputField($fieldName, $attr, $data, "text", $fieldClass, $fieldId);
        }
    }

    private function getSubmitData($action = "insert", $submitClass = "") {
        $hiddenExportTypeData = "";
        $cancelBtn = "";
        $submitBtnSaveBack = "";
        $submitBtnBack = "";
        $submitBtnSaveNew = "";
        $submitBtnSaveClose = "";

        if (isset($this->formExport)) {
            $action = "export";
            $attr = array(
                "data-action" => "export",
                "data-export-type" => $this->formExport
            );
            $hiddenExportTypeData = $this->getInputField("pdocrud_data[exportType]", $attr, array(
                $this->formExport
                    ), "hidden", array(
                "pdocrud-hidden-data",
                "pdocrudobj",
                "pdocrud_export_type"
            ));
        } else {
            $attr = array(
                "data-action" => $action
            );
        }

        $fieldName = "pdocrud_submit_" . $this->objKey;
        $cancelFieldName = "pdocrud_cancel_" . $this->objKey;
        $submitBtn = $this->getSubmitField($fieldName, $attr, array(
            $this->getLangData("save")
                ), array(
            $submitClass
        ));
        
        if (!isset($this->hideButton["cancel"]))
            $cancelBtn = $this->getButtonField($cancelFieldName, array(), array(
                $this->getLangData("cancel")
                    ), array(
                "pdocrud-cancel-btn"
            ));

        if ($action === "insert") {
            $attrSaveBack = array(
                "data-action" => "insert_back"
            );
            $attrBack = array(
                "data-action" => "back",
                "data-dismiss" => "modal"
            );
            if (isset($this->settings["saveBackButton"]) && $this->settings["saveBackButton"]) {
                $submitBtnSaveBack = $this->getSubmitField($fieldName . "_insert_back", $attrSaveBack, array(
                    $this->getLangData("save_and_back")
                        ), array(
                    $submitClass
                ));
            }
            if (isset($this->settings["backButton"]) && $this->settings["backButton"]) {
                $submitBtnBack = $this->getButtonField($fieldName . "_back", $attrBack, array(
                    $this->getLangData("back")
                        ), array(
                    "pdocrud-back"
                ));
            }
            if (isset($this->settings["saveCloseButton"]) && $this->settings["saveCloseButton"]) {
                $saveClosefieldName = "pdocrud_submit_close_" . $this->objKey;
                $submitBtnSaveClose = $this->getSubmitField($saveClosefieldName, array(
                    "data-action" => "insert_close"
                        ), array(
                    $this->getLangData("save_and_close")
                        ), array(
                    "pdocrud-save-close-btn"
                ));
            }
        } else if ($action === "update") {
            $attrSaveBack = array(
                "data-action" => "update_back"
            );
            $attrBack = array(
                "data-action" => "back",
                "data-dismiss" => "modal"
            );
            if (isset($this->settings["saveBackButton"]) && $this->settings["saveBackButton"]) {
                $submitBtnSaveBack = $this->getSubmitField($fieldName . "_update_back", $attrSaveBack, array(
                    $this->getLangData("save_and_back")
                        ), array(
                    $submitClass
                ));
            }
            if (isset($this->settings["backButton"]) && $this->settings["backButton"]) {
                $submitBtnBack = $this->getButtonField($fieldName . "_back", $attrBack, array(
                    $this->getLangData("back")
                        ), array(
                    "pdocrud-back"
                ));
            }
            if (isset($this->settings["saveCloseButton"]) && $this->settings["saveCloseButton"]) {
                $saveClosefieldName = "pdocrud_submit_close_" . $this->objKey;
                $submitBtnSaveClose = $this->getSubmitField($saveClosefieldName, array(
                    "data-action" => "update_close"
                        ), array(
                    $this->getLangData("save_and_close")
                        ), array(
                    "pdocrud-save-close-btn"
                ));
            }
        } else if ($action === "inline_edit") {
            $attrSaveBack = array(
                "data-action" => "inline_back"
            );
            $attrBack = array(
                "data-action" => "back"
            );
            $submitBtnSaveBack = $this->getSubmitField($fieldName . "_update_back", $attrSaveBack, array(
                $this->getLangData("save_and_back")
                    ), array(
                $submitClass
            ));
            $submitBtnBack = $this->getButtonField($fieldName . "_back", $attrBack, array(
                $this->getLangData("back")
                    ), array(
                "pdocrud-back"
            ));
            $submitBtn = "";
            $cancelBtn = "";
        } else if ($action === "selectform") {
            $submitBtn = $this->getSubmitField($fieldName, $attr, array(
                $this->getLangData("login")
                    ), array(
                $submitClass
            ));
        }
        if (!$this->crudCall) {
            $submitBtnSaveBack = "";
            $submitBtnBack = "";
        }

        $hiddenInstance = $this->getInputField("pdocrud_instance", array(), array(
            $this->objKey
                ), "hidden", array(
            "pdocrud-hidden-data",
            "pdocrudobj",
            "pdoobj"
        ));
        $hiddenActionData = $this->getInputField("pdocrud_data[action]", $attr, array(
            $action
                ), "hidden", array(
            "pdocrud-hidden-data",
            "pdocrudobj",
            "pdocrud_action_type",
        ));

        if (isset($this->hideButton["submitBtn"]))
            $submitBtn = "";
        if (isset($this->hideButton["submitBtnSaveBack"]))
            $submitBtnSaveBack = "";
        if (isset($this->hideButton["submitBtnBack"]))
            $submitBtnBack = "";

        return array(
            "submitBtn" => $submitBtn,
            "submitBtnSaveBack" => $submitBtnSaveBack,
            "submitBtnBack" => $submitBtnBack,
            "submitBtnSaveClose" => $submitBtnSaveClose,
            "cancelBtn" => $cancelBtn,
            "hiddenInstance" => $hiddenInstance,
            "hiddenActionData" => $hiddenActionData,
            "hiddenExportTypeData" => $hiddenExportTypeData
        );
    }

    private function getHTMLElementLable($fieldName, $encryptedFieldName, $type = "") {
        $lableClass = array();
        $lableText = str_replace("-", " ", ucfirst(str_replace("_", " ", $fieldName)));
        if (isset($this->fieldNames[$fieldName])) {
            $lableText = $this->fieldNames[$fieldName];
        } else if (($this->settings["hideLable"]) || (isset($this->hideFieldName[$fieldName]))) {
            if (isset($this->hideFieldName[$fieldName]["takeSpace"]) && $this->hideFieldName[$fieldName]["takeSpace"] === true) {
                $lableClass = array(
                    "invisible"
                );
            } else
                return "";
        } else if (($this->settings["hideHTMLLable"]) && ($type === "HTML")) {
            return "";
        }

        if (strtolower($this->form["formType"]) === "horizontal")
            $lableClass = array_merge($lableClass, $this->settings["lableClass"]);

        return $this->getLableField($lableText, $encryptedFieldName, $lableClass);
    }

    private function getHTMLElementBlockClass($fieldName) {
        if (isset($this->fieldBlockClass[$fieldName]))
            return $this->fieldBlockClass[$fieldName];
        else if (strtolower($this->form["formType"]) === "horizontal")
            return implode(" ", $this->settings["blockClass"]);
        else
            return "";
    }

    private function getHTMLElementGroup($fieldName) {
        if (isset($this->fieldGroup))
            foreach ($this->fieldGroup as $groupname => $group) {
                if (in_array($fieldName, $group)) {
                    $key = array_search($fieldName, $group);
                    if ($key === 0)
                        return "start";
                    else if ($key === count($group) - 1)
                        return "end";

                    return $key;
                }
            }
        return 0;
    }

    private function getHTMLElementTooltip($fieldName) {
        if (isset($this->tooltip[$fieldName])) {
            return $this->getToolTipField($this->tooltip[$fieldName]["tooltip"], $this->tooltip[$fieldName]["tooltipIcon"]);
        }
        return "";
    }

    private function getHTMLElementDesc($fieldName) {
        if (isset($this->fieldDesc[$fieldName])) {
            return $this->getDescField($this->fieldDesc[$fieldName]["desc"]);
        }
        return $this->getDescField();
    }

    private function getHTMLElementAddOn($fieldName, $position = "before") {
        if (isset($this->fieldAddOn[$fieldName][$position]))
            return $this->fieldAddOn[$fieldName][$position];
    }

    private function getHTMLElementFieldOrder($fieldName) {
        if (isset($this->fieldOrder)) {
            if (in_array($fieldName, $this->fieldOrder))
                return array_search($fieldName, $this->fieldOrder);
        }
        $this->fieldDefaultOrder++;
        return $this->fieldDefaultOrder;
    }

    private function getHTMLContent($html) {
        if (is_array($html))
            return $html[0];
        return $html;
    }

    private function getFormPopup($form) {
        $content = $this->getMoodelContent($this->formId, $this->formPopup["buttonContent"], $this->formPopup["headerContent"], $form);
        return $content;
    }

    private function getRelatedTable($data, $result) {
        if (isset($this->multiTableRelationDisplay) && $this->multiTableRelationDisplay["display"] === "tab")
            return $this->getRelatedTableTab($data, $result);
        else
            return $this->getRelatedTableDefault($data, $result);
    }

    private function getRelatedTableTab($data, $result) {
        $output = "";
        $stepHeader = "";
        $stepBody = "";
        $stepstart = "<div id=\"tabs\" class=\"pdocrud_tabs\"><ul class=\"stepy-titles clearfix\">";
        $stepend = "</ul>";
        $tabTitle = $this->tableName;
        if (isset($this->multiTableRelationDisplay["title"]) && !empty($this->multiTableRelationDisplay["title"]))
            $tabTitle = $this->multiTableRelationDisplay["title"];
        $stepHeader = $this->getStepHeader($this->tableName, $this->multiTableRelationDisplay["title"]);
        $stepBody .= "<div id='" . $this->tableName . "'>" . $data . "</div>";
        foreach ($this->multiTableRelation as $relation) {
            $obj = $relation["obj"];
            $stepHeader .= $this->getStepHeader($obj->tableName, $obj->multiTableRelationDisplay["title"]);

            if (isset($relation["field2"]) && isset($relation["field1"])){
                $obj->where($relation["field2"], $result[0][$relation["field1"]]);
                $obj->formStaticFields($relation["field2"], "hidden", array($result[0][$relation["field1"]]), "db", $relation["field2"]); 
            }

            $stepBody .= "<div id='" . $obj->tableName . "'>" . $obj->render($relation["renderParam"]) . "</div>";
        }
        $output .= $stepstart . $stepHeader . $stepend . $stepBody . "</div>";
        return $output;
    }

    private function getRelatedTableDefault($data, $result) {
        foreach ($this->multiTableRelation as $relation) {
            $obj = $relation["obj"];
            if (isset($relation["field2"]) && isset($relation["field1"])){
                $obj->where($relation["field2"], $result[0][$relation["field1"]]);
                $obj->formFieldValue($relation["field2"], $result[0][$relation["field1"]]);
                $obj->formStaticFields($relation["field2"], "hidden", array($result[0][$relation["field1"]]), "db", $relation["field2"]); 
            }

            $data .= $obj->render($relation["renderParam"]);
        }
        return $data;
    }

    private function getSidebarData($data, $result) {
        $sidebar = $this->getSidebar($result[0]);
        $data = $this->getDiv("pdocrud-main-content", array("class" => "col-sm-9 pdocrud-main-bar"), $data);
        if ($this->sidebar["position"] === "left")
            $output = $sidebar . $data;
        else
            $output = $data . $sidebar;
        return $output;
    }
    

    private function addWhereCondition(PDOModel $pdoModelObj, $data = array()) {
        if (!isset($this->searchOperator))
            $this->searchOperator = $this->settings["searchOperator"];
        if(isset($this->searchBoxCols))
            $this->searchCols = $this->searchBoxCols;
        
        $this->isRelData = false;
        $pdoModelObj = $this->searchRelData($pdoModelObj, $data);
        
        if (isset($data["search_col"]) && isset($data["search_text"]) && !$this->isRelData) {
            if (isset($data["search_text2"])) {
                $pdoModelObj->where($this->decrypt($data["search_col"]), array($data["search_text"], $data["search_text2"]), "BETWEEN");
                return $pdoModelObj;
            }
            if (strtolower($this->searchOperator) === "like")
                $data["search_text"] = "%" . $data["search_text"] . "%";

            if ($data["search_col"] === "all") {
                $pdoModelObj->openBrackets = "(";
                $colCount = count($this->searchCols);
                $loopCol = 0;
                foreach ($this->searchCols as $key => $col) {
                    if(isset($this->joinTable))
                      $col = $this->getJoinColFullName($col);
                    if(++$loopCol ===  $colCount)
                        $pdoModelObj->closedBrackets = ")";
                    $pdoModelObj = $this->searchRelData($pdoModelObj, $data, $col);
                    if(!$this->isRelData)
                        $pdoModelObj->where($col, $data["search_text"], $this->searchOperator);
                    else
                        $this->isRelData = true;
                    $pdoModelObj->andOrOperator = "or";
                }
                $pdoModelObj->andOrOperator = "and";
            } else {
                $col = $this->decrypt($data["search_col"]);
                if(isset($this->joinTable))
                    $col = $this->getJoinColFullName($this->decrypt($data["search_col"]));
                $pdoModelObj->where($col, $data["search_text"], $this->searchOperator);
            }
        } else if (isset($this->search["search_col"]) && isset($this->search["search_text"]) && !$this->isRelData) {
            $data["search_col"] = $this->search["search_col"];
            $data["search_text"] = $this->search["search_text"];

            if (isset($this->search["search_text2"])) {
                $pdoModelObj->where($this->decrypt($data["search_col"]), array($data["search_text"], $this->search["search_text2"]), "BETWEEN");
                return $pdoModelObj;
            }

            if (strtolower($this->searchOperator) === "like")
                $data["search_text"] = "%" . $data["search_text"] . "%";

            if ($data["search_col"] === "all") {
                $pdoModelObj->openBrackets = "(";
                $colCount = count($this->searchCols);
                $loopCol = 0;
                foreach ($this->searchCols as $col) {
                    if(isset($this->joinTable))
                      $col = $this->getJoinColFullName($col);
                     if(++$loopCol ===  $colCount)
                        $pdoModelObj->closedBrackets = ")";
                     $pdoModelObj = $this->searchRelData($pdoModelObj, $data, $col);
                    if(!$this->isRelData)
                        $pdoModelObj->where($col, $data["search_text"], $this->searchOperator);
                    else
                        $this->isRelData = true;
                    $pdoModelObj->andOrOperator = "or";
                }
                $pdoModelObj->andOrOperator = "and";
            } else {
                $col = $this->decrypt($data["search_col"]);
                if(isset($this->joinTable))
                    $col = $this->getJoinColFullName($this->decrypt($data["search_col"]));
                $pdoModelObj->where($col, $data["search_text"], $this->searchOperator);
            }
        }
        
        if (isset($data["action"]) && $data["action"] === "filter" && !isset($data["filter_data"])) {
             $this->filterData = $data;
        }
        
        if (isset($data["filter_data"]) && is_array($data["filter_data"]) && count($data["filter_data"])) {
            foreach ($data["filter_data"] as $filter) {
                if (strtolower($this->searchOperator) === "like")
                    $filter["value"] = "%" . $filter["value"] . "%";
                $pdoModelObj->where($this->crudFilter[$filter["key"]]["matchingCol"], $filter["value"], $this->searchOperator);
            }
            $this->filterData = $data;
        } else if (isset($this->filterData["filter_data"]) && is_array($this->filterData["filter_data"]) && count($this->filterData["filter_data"])) {
            foreach ($this->filterData["filter_data"] as $filter) {
                if (strtolower($this->searchOperator) === "like")
                    $filter["value"] = "%" . $filter["value"] . "%";
                $pdoModelObj->where($this->crudFilter[$filter["key"]]["matchingCol"], $filter["value"], $this->searchOperator);
            }
        }

        if (isset($this->whereCondition)) {
            foreach ($this->whereCondition as $colWhere => $where){
                if(isset($where["bracket"]) && $where["bracket"] === "("){
                    $pdoModelObj->openBrackets = "(";
                }
                if(isset($where["andOroperator"]) && !empty($where["andOroperator"])){
                    $pdoModelObj->andOrOperator = $where["andOroperator"];
                }
                $pdoModelObj->where($where["colName"], $where["val"], $where["operator"]);
                if(isset($where["bracket"]) && $where["bracket"] === ")"){
                    $pdoModelObj->closedBrackets = ")";
                }
            }
            $pdoModelObj->andOrOperator = "AND";
        }
        
        if (isset($data["actionId"])) {
            $currentDate = date('Y-m-d H:i:s');
            $fromDate = $this->getDateRangeFromDate($this->dateRangeReport[$data["actionId"]]["type"]);
            $pdoModelObj->where($this->dateRangeReport[$data["actionId"]]["dateField"], array($fromDate, $currentDate), "BETWEEN");
            $this->dateRangeData = $data;
        } else if (isset($this->dateRangeData["actionId"])) {
            $currentDate = date('Y-m-d H:i:s');
            $fromDate = $this->getDateRangeFromDate($this->dateRangeReport[$this->dateRangeData["actionId"]]["type"]);
            $pdoModelObj->where($this->dateRangeReport[$this->dateRangeData["actionId"]]["dateField"], array($fromDate, $currentDate), "BETWEEN");
        }
        
        if (isset($data["form_data"])) {
            parse_str($data["form_data"], $form_data);
            foreach ($form_data as $field => $val) {
                $col = explode($this->tableFieldJoin, $this->decrypt($field));
                if(!empty(trim($val)))
                    $pdoModelObj->where($col[1], $val);
            }
            $this->advSearchData = $data;
        } else if (isset($this->advSearchData["form_data"])) {
            parse_str($this->advSearchData["form_data"], $form_data);
            foreach ($form_data as $field => $val) {
                $col = explode($this->tableFieldJoin, $this->decrypt($field));
                if(!empty(trim($val)))
                    $pdoModelObj->where($col[1], $val);
            }
        }
        
        $this->search = $data;
        if (isset($this->settings["resetSearch"]) && $this->settings["resetSearch"] === true && empty($this->search["search_text"]))
            $this->search = array();
        if (isset($this->settings["resetSearch"]) && $this->settings["resetSearch"] === true && is_array($this->filterData) && count($this->filterData) === 0)
            $this->filterData = array();
        return $pdoModelObj;
    }
    
    private function searchRelData($pdoModelObj, $data, $column = ""){
        if (isset($this->relData) && (isset($data["search_col"]) || isset($this->search["search_col"]))) {
            if (!isset($data["search_col"]) && isset($this->search["search_col"])) {
                $data["search_col"] = $this->search["search_col"];
                $data["search_text"] = $this->search["search_text"];
            }
            foreach ($this->relData as $relData) {
                $col = empty($column) ? $this->decrypt($data["search_col"]) :  $column;
                if (isset($relData["mainTableCol"]) && strtolower($relData["mainTableCol"]) === strtolower($col)) {
                    $col = $this->getRelatedColumn($relData, false);
                    if (strtolower($this->searchOperator) === "like")
                        $data["search_text"] = "%" . $data["search_text"] . "%";
                    $pdoModelObj->where($col, $data["search_text"], $this->searchOperator);
                    $this->isRelData = true;
                }
            }
        }
        return $pdoModelObj;
    }

    private function formatDatasource($dataSource) {
        $data = array();
        if (is_array($dataSource)) {
            foreach ($dataSource as $key => $val) {
                $data[] = array(
                    $key,
                    $val
                );
            }
        } else {
            $data[] = $dataSource;
        }
        return $data;
    }

    private function addError($error) {
        return $this->pdocrudErrCtrl->addError($error, false);
    }
    
    private function encryptPassword($method, $val) {
        switch (strtolower($method)) {
            case "base64_encode": return base64_encode($val);
            case "md5": return md5($val);
            case "sha1": return sha1($val);
            default:$method($val);
        }
    }

    /**
     * Returns an encrypted string
     */
    private function encrypt($string) {
        if ($this->settings["encryption"]) {
            $string = $string . $this->settings["salt"];
            return base64_encode($string);
        }
        return $string;
    }

    /**
     * Returns decrypted original string
     */
    private function decrypt($string) {
        if ($this->settings["encryption"]) {
            $string = base64_decode($string);
            return str_replace($this->settings["salt"], "", $string);
        }
        return $string;
    }

    private function getDependentData($data) {
        $pdoModelObj = $this->getPDOModelObj();
        $dependent = explode($this->tableFieldJoin, $this->decrypt($data["pdocrud_dependent_name"]));
        $dependentFieldName = $dependent[1];
        if (isset($this->fieldDataBind[$dependentFieldName])) {
            $pdoModelObj->columns = array(
                $this->fieldDataBind[$dependentFieldName]["key"],
                $this->fieldDataBind[$dependentFieldName]["val"]
            );
            $tablename = $this->fieldDataBind[$dependentFieldName]["tableName"];
            $dependOnFieldName = $this->fieldDepend[$dependentFieldName]["colName"];
            $pdoModelObj->where($dependOnFieldName, $data["pdocrud_field_val"]);
            $fieldData = $pdoModelObj->select($tablename);
        } else if (isset($this->advSearchDataSource[$dependentFieldName])) {
            $pdoModelObj->columns = array(
                $this->advSearchDataSource[$dependentFieldName]["key"],
                $this->advSearchDataSource[$dependentFieldName]["val"]
            );
            $tablename = $this->advSearchDataSource[$dependentFieldName]["dataSource"];
            $dependOnFieldName = $this->fieldDepend[$dependentFieldName]["colName"];
            $pdoModelObj->where($dependOnFieldName, $data["pdocrud_field_val"]);
            $fieldData = $pdoModelObj->select($tablename);
        }
        echo $this->getHTMLElement($data["pdocrud_dependent_name"], "SELECT", array(), array(), $fieldData);
    }

    public function getPDOModelObj() {
        $pdoModelObj = new PDOModel();
        $pdoModelObj->setErrorCtrl($this->pdocrudErrCtrl);
        if ($pdoModelObj->connect($this->settings["hostname"], $this->settings["username"], $this->settings["password"], $this->settings["database"], $this->settings["dbtype"], $this->settings["characterset"])) {
            return $pdoModelObj;
        } else {
            $this->addError($this->getLangData("db_connection_error"));
            die();
        }
    }

    public function showChart($charts) {
        $output = "";
        foreach ($charts as $chart) {
            $chartName = $chart;
            if (isset($this->chart[$chartName])) {
                extract($this->chart[$chartName]);
                switch (strtolower($chartType)) {
                    case "easypie":
                        $chartData["data-percent"] = $this->getChartData($chartName, $chartType);
                        $output .= $this->getDiv($chartName, $chartData, $chartData["data-percent"] . "%");
                        break;
                    case "sparkline":
                        $chartData = $param;
                        $chartData["data-data"] = $this->getChartData($chartName, $chartType);
                        $output .= $this->getDiv($chartName, $chartData);
                        break;
                    case "google-chart":
                        $this->chartData[$chartName]["param"] = $param;
                        $this->chartData[$chartName]["data"] = $this->getChartData($chartName, $chartType);
                        $output .= $this->getDiv($chartName);
                        break;
                }
            }
        }
        return $output;
    }

    private function getChartData($chartName, $chartType) {
        extract($this->chart[$chartName]);
        if ($bind === "array") {
            $data = $this->formatDatasource($dataSource);
        } else if ($bind === "db") {
            $pdoModelObj = $this->getPDOModelObj();
            $pdoModelObj->columns = array(
                $key,
                $val
            );
            $data = $pdoModelObj->select($dataSource);
        } else if ($bind === "sql") {
            $pdoModelObj = $this->getPDOModelObj();
            $data = $pdoModelObj->executeQuery($dataSource);
        }
        switch (strtolower($chartType)) {
            case "easypie":
                $percentage = array_values($data[0]);
                if (isset($percentage[1]))
                    return $percentage[1];
                else
                    return $percentage[0];
            case "sparkline":
                foreach ($data as $val) {
                    $val = array_values($val);
                    if (isset($val[1]))
                        $chartData[] = $val[1];
                    else
                        $chartData[] = $val[0];
                }
                return "[" . implode(",", $chartData) . "]";
                break;
            case "google-chart":
                return $data;
                break;    
        }
        return $data;
    }

    public function addHTML($data) {
        return $data[0];
    }

    public function callbackTriggerOperation($data, $obj) {
        foreach ($this->triggerOperation as $dbTableName => $operation) {
            extract($operation);
            $pdoModelObj = $this->getPDOModelObj();
            $triggerData = $this->getTriggerFormatedData($colVal, $data);
            $whereData = $this->getTriggerFormatedData($where, $data);
            if (is_array($triggerData) && count($triggerData) > 0) {
                if ($operationType === "insert") {
                    $pdoModelObj->insert($dbTableName, $triggerData);
                } else if ($operationType === "update") {
                    $pdoModelObj->update($dbTableName, $triggerData, $whereData);
                } else if ($operationType === "delete") {
                    $pdoModelObj->delete($dbTableName, $whereData);
                }
            }
        }
        return $data;
    }

    private function getTriggerFormatedData($colVal, $data) {
        $triggerData = array();
        foreach ($colVal as $colname => $row) {
            if ($row["type"] === "fixed")
                $triggerData[$colname] = $row["val"];
            else if ($row["type"] === "array_data" && isset($data[$this->tableName][$row["val"]]))
                $triggerData[$colname] = $data[$this->tableName][$row["val"]];
            else if ($row["type"] === "last_insert_id")
                $triggerData[$colname] = $data;
        }
        return $triggerData;
    }

    public function emailPassword($data, $obj) {
        if (is_array($data) && count($data) > 0) {
            $to = array($data[0]["email"]);
            $subject = $obj->forgotPass["subject"];
            $message = trim($obj->forgotPass["message"]);
            $newPassword = $this->getRandomKey(true);
            $pdoModelObj = $this->getPDOModelObj();
            $updateData = array($obj->forgotPass["password"] => $newPassword);
            $pdoModelObj->where($obj->forgotPass["email"], $to);
            $pdoModelObj->update($this->tableName, $updateData);
            if (empty($message))
                $message = "Your password has been reseted successfully. Your new password is " . $newPassword;
            $from = $obj->forgotPass["from"];
            $message = str_replace("{password}", $newPassword, $message);
            $this->sendEmail($to, $subject, $message, $from);
        }
        return $data;
    }
    

    /*     * ******************* Fields HTML ************************************* */

    public function getInputField($fieldName, $attr = array(), $data = array(), $type = "text", $fieldClass = array(), $fieldId = "") {
        $class = implode(" ", $fieldClass);
        $id = empty($fieldId) ?$fieldName: $fieldId;
        $field = "<input type=\"$type\" class=\"form-control pdocrud-form-control pdocrud-$type $class\" id=\"$id\" name=\"$fieldName\" ";
        if (is_array($attr) && count($attr)) {
            foreach ($attr as $c => $v) {
                $field .= " $c=\"$v\" ";
            }
        }

        if (is_array($data) && count($data)) {
            $field .= " value=\"$data[0]\" ";
        }
        $field .= " />";
        return $field;
    }

    public function getSubmitField($fieldName, $attr = array(), $data = array(), $fieldClass = array()) {
        $class = implode(" ", $fieldClass);
        $formId = $this->formId;
        $field = "<input data-form-id=\"$formId\" type=\"submit\" class=\"btn btn-info pdocrud-form-control pdocrud-submit $class\" id=\"$fieldName\" name=\"$fieldName\" ";
        if (is_array($attr) && count($attr)) {
            foreach ($attr as $c => $v) {
                $field .= " $c=\"$v\" ";
            }
        }

        if (is_array($data) && count($data)) {
            $field .= " value=\"$data[0]\" ";
        }
        $field .= " />";
        return $field;
    }

    public function getButtonField($fieldName, $attr, $data = array(), $fieldClass = array()) {
        $class = implode(" ", $fieldClass);
        $formId = $this->formId;
        $field = "<button data-form-id=\"$formId\" type=\"button\" class=\"btn btn-info pdocrud-form-control pdocrud-button $class\" id=\"$fieldName\" name=\"$fieldName\" ";
        $buttonText = "";

        if (is_array($attr) && count($attr)) {
            foreach ($attr as $c => $v) {
                $field .= " $c=\"$v\" ";
            }
        }

        if (is_array($data) && count($data)) {
            $buttonText = $data[0];
        }
        $field .= " >$buttonText</button>";
        return $field;
    }

    public function getGoogleMap($fieldName, $attr, $data, $fieldClass = array()) {
        $class = implode(" ", $fieldClass);
        $field = "<input type=\"text\" class=\"form-control pdocrud-form-control pdocrud-text $class\" id=\"$fieldName\" name=\"$fieldName\" ";

        if (is_array($attr) && count($attr)) {
            foreach ($attr as $c => $v) {
                $field .= " $c=\"$v\" ";
            }
        }
        if (is_array($data) && count($data)) {
            $field .= " value=\"$data[0]\" ";
        }
        $field .= " />";
        $rand = $this->getRandomKey();
        $field .= "<div id='pdocrud_gmap_$rand' class='pdocrud-gmap'></div>";

        return $field;
    }

    public function getTextareaField($fieldName, $attr, $data, $fieldClass = array()) {
        $class = implode(" ", $fieldClass);
        $field = "<textarea class=\"form-control pdocrud-form-control  pdocrud-textarea $class\" id=\"$fieldName\" name=\"$fieldName\" ";

        if (is_array($attr) && count($attr)) {
            foreach ($attr as $c => $v) {
                $field .= " $c=\"$v\" ";
            }
        }
        $field .= ">";
        if (is_array($data) && count($data)) {
            $field .= $data[0];
        }
        $field .= "</textarea>";
        return $field;
    }

    public function getSelectField($fieldName, $attr, $data, $fieldData, $fieldClass = array()) {
        $class = implode(" ", $fieldClass);
        $field = "<select class=\"form-control pdocrud-form-control pdocrud-select $class\" id=\"$fieldName\" name=\"$fieldName\"";
        $multi = false;
        if (is_array($attr) && count($attr)) {
            foreach ($attr as $c => $v) {
                $field .= " $c=\"$v\" ";
                if($c === "multiple"){
                    $multi = true;
                }
            }
        }
        $field .= ">";
        if ($this->settings["selectOption"])
            $field .= "<option value=''>" . $this->langData["select"] . "</option>";

        if($multi && isset($data[0]))
            $data = explode(",", $data[0]);

        if (is_array($fieldData) && count($fieldData)) {
            foreach ($fieldData as $fieldsval) {
                $fieldsval = array_values($fieldsval);
                $selected = "";
                if (in_array($fieldsval[0], $data))
                    $selected = "selected=\"selected\"";

                $field .= "<option $selected value=\"$fieldsval[0]\">$fieldsval[1]</option>";
            }
        }
        $field .= "</select>";
        return $field;
    }

    public function getRadioButtonField($fieldName, $attr, $data, $fieldData, $fieldClass = array()) {
        $class = implode(" ", $fieldClass);
        $field = "<div class=\"radio pdocrud-radio-group\">";
        if (is_array($fieldData) && count($fieldData)) {
            $loopFields = 0;
            foreach ($fieldData as $fieldsval) {
                $field .= "<label class=\"radio-inline\">";
                $field .= "<input type=\"radio\" class=\"pdocrud-form-control pdocrud-radio $class\" id=\"$fieldName.$loopFields\" name=\"$fieldName\" ";

                if (is_array($attr) && count($attr)) {
                    foreach ($attr as $c => $v) {
                        $field .= " $c=\"$v\" ";
                    }
                }

                $fieldsval = array_values($fieldsval);
                $field .= "value=\"$fieldsval[0]\" ";
                $selected = "";
                if (in_array($fieldsval[0], $data))
                    $field .= "checked=\"checked\"";

                $field .= " />";
                $field .= $fieldsval[1];
                $field .= "</label>";
                $loopFields++;
            }
        }
        $field .= "</div>";
        return $field;
    }

    public function getCheckboxField($fieldName, $attr, $data, $fieldData, $fieldClass = array()) {
        $class = implode(" ", $fieldClass);
        $field = "<div class=\"checkbox pdocrud-checkbox-group\">";
        if (is_array($fieldData) && count($fieldData)) {
            $loopFields = 0;
            foreach ($fieldData as $fieldsval) {
                $field .= "<label class=\"checkbox-inline\">";
                $field .= "<input type=\"checkbox\" class=\"pdocrud-form-control pdocrud-checkbox $class\" id=\"$fieldName.$loopFields\" name=\"$fieldName\" ";

                if (is_array($attr) && count($attr)) {
                    foreach ($attr as $c => $v) {
                        $field .= " $c=\"$v\" ";
                    }
                }

                $fieldsval = array_values($fieldsval);
                $field .= "value=\"$fieldsval[0]\" ";
                $selected = "";
                if (isset($data[0]) && !empty($data[0])) {
                    $values = explode(",", $data[0]);
                    if (is_array($values) && count($values)) {
                        if (in_array($fieldsval[0], $values))
                            $field .= "checked=\"checked\"";
                    }
                }

                $field .= " />";
                $field .= $fieldsval[1];
                $field .= "</label>";
                $loopFields++;
            }
        }
        $field .= "</div>";
        return $field;
    }

    public function getCaptcha($fieldName) {

        $imageSrc = $this->settings["script_url"] . "/script/classes/library/captchamath/CaptchaMath.php?objId=$this->formId";
        $captchaId = "captcha_" . $this->formId;
        $captchaImage = $this->getImageField($imageSrc, array(
            "id" => $captchaId
                ), array(
            "captcha"
        ));
        $captchaTextbox = $this->getInputField($fieldName);
        $captchaHTML = " Can't read the image? click <a href=\"javascript: refreshCaptcha('" . $captchaId . "','" . $imageSrc . "');\">here</a> to refresh.</td>";
        return $captchaImage . $captchaTextbox . $captchaHTML;
    }

    public function getImageField($imageSrc, $attr = array(), $imageClass = array()) {
        $class = implode(" ", $imageClass);
        $image = "<img src=\"$imageSrc\" class=\"$class\" ";
        if (is_array($attr) && count($attr)) {
            foreach ($attr as $c => $v) {
                $image .= " $c=\"$v\" ";
            }
        }
        $image .= " />";
        return $image;
    }

    public function getListElements($data, $attr = array(), $position = "1", $listElementTag = "ul") {
        $listElement = "";

        if (is_array($attr) && count($attr)) {
            $listattr = "";
            foreach ($attr as $c => $v) {
                $listattr .= " $c=\"$v\" ";
            }
        }

        if ($position === 0)
            $listElement .= "<" . $listElementTag . " $listattr>";
        else if ($position === -1)
            $listElement .= "</$listElementTag>";
        else {
            if (is_array($data)) {
                foreach ($data as $row) {
                    $listElement .= "<li $listattr>$row</li>";
                }
            }
        }

        return $listElement;
    }

    public function getSpanField($spanText, $spanClass = array()) {
        $class = implode(" ", $spanClass);
        $class .= " pdocrud-span";
        $span = "<span class=\"$class\">$spanText</span>";
        return $span;
    }

    public function getLableField($lableText, $lableFor, $lableClass = array()) {
        $class = implode(" ", $lableClass);
        $class .= " control-label";
        $lable = "<label for=\"$lableFor\" class=\"$class\">$lableText</label>";
        return $lable;
    }

    public function getToolTipField($tooltip, $tooltipIcon) {
        $tooltip = "<a class=\"right\" title=\"$tooltip\" data-placement=\"right\" data-toggle=\"tooltip\" href=\"javascript:;\" data-original-title=\"$tooltip\">$tooltipIcon</a>";
        return $tooltip;
    }

    public function getAnchorField($text, $url = "javascript:;", $attr = array(), $anchorClass = array()) {
        $class = implode(" ", $anchorClass);
        $anchor = "<a class=\"$class\" href=\"$url\"";
        if (is_array($attr) && count($attr)) {
            foreach ($attr as $c => $v) {
                $anchor.= " $c=\"$v\" ";
            }
        }
        $anchor.= ">$text</a>";
        return $anchor;
    }

    public function getDescField($helpMsg = "") {
        $desc = "<p class=\"pdocrud_help_block help-block with-errors\">$helpMsg</p>";
        return $desc;
    }

    public function getAjaxLoaderImage($imagepath) {
        $ajaximg = "<div id=\"pdocrud-ajax-loader\"><img src=\"$imagepath\" class=\"pdocrud-img-ajax-loader\"/></div>";
        return $ajaximg;
    }

    public function getSlider($attr = array(), $fieldClass = array()) {
        $class = implode(" ", $fieldClass);
        $field = "<div class=\"pdocrud-slider $class\"";
        if (is_array($attr) && count($attr)) {
            foreach ($attr as $c => $v) {
                $field .= " $c=\"$v\" ";
            }
        }

        $field .= " ><div id=\"pdocrud-custom-handle\" class=\"ui-slider-handle\"></div></div>";
        return $field;
    }

    public function getImagePreviewField($fieldName, $attr = array(), $data = array(), $type = "text", $fieldClass = array()) {
        $file = $this->getInputField($fieldName, $attr, $data, "file", $fieldClass);
        $img = "";
        if (is_array($data) && count($data)) {
            $img = "<img src=\"$data[0]\" class=\"thumbnail\" style=\"max-width: 250px; max-height: 250px\">  ";
        }
        return '<div class="imageupload panel panel-default">
                <div class="file-tab panel-body">
                ' . $img . '<label class="btn btn-default btn-file">
                        <span>' . $this->getLangData("browse") . '</span>
                        ' . $file . '</label>
                    <button type="button" class="btn btn-default">' . $this->getLangData("remove") . '</button>
                </div>
            </div>';
    }

    public function getDiv($divId = "", $params = array(), $content = "") {
        if (!empty($divId)) {
            $params["id"] = $divId;
        }
        $param = implode(' ', array_map(
                        function ($v, $k) {
                    return $k . '="' . $v . '"';
                }, $params, array_keys($params)
        ));
        $div = "<div $param>$content</div>";
        return $div;
    }

    public function getFileUploadField($fieldName, $attr, $data, $fieldData, $fieldClass = array()) {
        $classAdd = array_merge($fieldClass, array("pdocrud_add_file"));
        $classRemove = array_merge($fieldClass, array("pdocrud_remove_file"));
        $textAdd = "<i class=\"fa fa-upload\" aria-hidden=\"true\"></i> " . $this->getLangData("add");
        $textRemove = "<i class=\"fa fa-times\" aria-hidden=\"true\"></i> " . $this->getLangData("remove");
        $fileAddBtn = $this->getButtonField($fieldName, $attr, array($textAdd), $classAdd);
        $fileRemoveBtn = $this->getButtonField($fieldName . "_remove", $attr, array($textRemove), $classRemove);
        $fileAttr = $attr;
        unset($fileAttr['required']);
        $displayImage = "";
        if (isset($data[0]) && isset($this->settings["showUploadedImage"]) && $this->settings["showUploadedImage"]) {
            $imageAttr = array("title" => $this->getLangData("image_uploaded"));
            $imageClass = array("pdocrud-image-upload-display");
            $allowedFileTypes = array("jpg", "png", "gif");
            if (is_array($allowedFileTypes) && count($allowedFileTypes) > 0) {
                $fileExtensionLowerCase = strtolower($this->getFileExtension($data[0]));
                if (in_array($fileExtensionLowerCase, $allowedFileTypes)) {
                    $displayImage = $this->getImageField($data[0], $imageAttr, $imageClass);
                }
            }
        }
        $fileControl = $this->getInputField($fieldName, $fileAttr, $data, "file", $fieldClass);
        $fileControlDiv = $this->getDiv("", array("class" => "pdocrud-filecontrol-div"), $fileControl);
        $attr = array_merge($attr, array("readonly" => "true"));
        $fieldClass = array_merge($fieldClass, array("pdocrud-file-input-control"));
        $inputControl = $this->getInputField($fieldName . "_pdocrud_file_input", $attr, $data, "text", $fieldClass);
        $fileUpload = $displayImage . $inputControl . $fileAddBtn . $fileRemoveBtn . $fileControlDiv;
        return $fileUpload;
    }

    public function getSearchBox($columns, $data = array()) {
        $searchContent = "";
        $searchContent2 = "";
        $search = "<div class=\"col-md-5 col-sm-12 col-xs-12 pdo-search-cols form-group\">";
        $search .= "<select class=\"form-control pdocrud-form-control pdocrud_search_cols\">";
        if(isset($this->settings["showAllSearch"]) && $this->settings["showAllSearch"])
        $search .= "<option value=\"all\">" . $this->langData["all"] . "</option>";
        if (is_array($columns) && count($columns)) {
            foreach ($columns as $k => $v) {
                if(isset($this->searchBoxCols) && count($this->searchBoxCols)){
                    if(!in_array($v["col"], $this->searchBoxCols))
                            continue;
                }
                $selected = "";
                if (isset($data["search_col"]) && $data["search_col"] == $k)
                    $selected = "selected=selected";
                $search .= "<option $selected value=\"$k\" data-type='" . $v["type"] . "'>" . $v["colname"] . "</option>";
            }
        }
        $search .= "</select></div>";
        $search .= "<div class=\"col-md-5 col-sm-10 col-xs-10 pdo-table-search form-group no-padding-right\">";
        if (isset($data["search_col"]))
            $searchContent = array(
                $data["search_text"]
            );
        $search .= $this->getInputField("pdocrud_search_box", array(
            "placeholder" => $this->getLangData("search"),
                ), $searchContent, "text", array(
            "pdocrud_search_input"
        ));
        $searchTextToClass = "pdocrud-hide";
        if (isset($data["search_text2"])) {
            $searchContent2 = array(
                $data["search_text2"]
            );
            $searchTextToClass = "";
        }
        $search .= $this->getInputField("pdocrud_search_box_to", array(
            "placeholder" => $this->getLangData("to"),
                ), $searchContent2, "text", array(
            "pdocrud_search_input", $searchTextToClass
        ));

        $class = "";
        if ($this->settings["template"] === "pure")
            $class = "btn btn-primary";

        $search .= "</div>";
        $search .= "<div class=\"col-md-1 col-sm-1 col-xs-1 pdo-search-cols no-padding\">";
        $search .= "<a href=\"javascript:;\" id=\"pdocrud_search_btn\" name=\"pdocrud_search_btn\" class=\"pdocrud-form-control pdocrud-actions $class\" data-action=\"search\">";
        $search .= $this->langData["go"];
        $search .= "</a>";
        $search .= "</div>";
        return $search;
    }

    public function perPageRecords($totalRecords, $data = array()) {
        if (isset($this->recordsPerPageList) && count($this->recordsPerPageList)) {
            
            foreach($this->recordsPerPageList as $val){
                $records[] = array($val,$val);
            }
            
        } else {
            $records = array(
                array(
                    "10",
                    "10"
                ),
                array(
                    "25",
                    "25"
                ),
                array(
                    "50",
                    "50"
                ),
                array(
                    "100",
                    "100"
                ),
                array(
                    "All",
                    "All"
                )
            );
        }
        return $this->getSelectField("pdocrud_records_per_page", array(
                    "data-action" => "records_per_page"
                        ), $data, $records, array(
                    "pdocrud-records-per-page"
        ));
    }

    public function getStepHeader($stepId, $stepName, $type = "tab") {
        if ($type === "tab")
            $stepHeader = "<li class=\"step-class\"><a href=\"#$stepId\">$stepName</a></li>";
        else if ($type === "stepy")
            $stepHeader = "<li id=\"$stepId\" class=\"step-class\"><div>$stepName<div></li>";
        return $stepHeader;
    }

    public function getMoodelContent($fieldName, $buttonContent, $headerContent, $bodyContent) {
        $attr = array(
            "data-toggle" => "modal",
            "data-target" => "#" . $fieldName
        );
        $data[0] = $buttonContent;
        $moodleButton = "";
        if (!empty($buttonContent))
            $moodleButton = $this->getButtonField($fieldName . $this->getRandomKey(), $attr, $data);
        $moodleStart = $this->getMoodleStartContainer($fieldName);
        $moodleHeader = $this->getMoodleHeader($headerContent);
        $moodleBody = $this->getMoodleBody($bodyContent);
        $moodleEnd = $this->getMoodleEndContainer();
        return $moodleButton . $moodleStart . $moodleHeader . $moodleBody . $moodleEnd;
    }

    private function getMoodleStartContainer($fieldName) {
        $moodleContainer = "<div class=\"modal fade\" id=\"$fieldName\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\">
                            <div class=\"modal-dialog\" role=\"document\">
                            <div class=\"modal-content\">";
        return $moodleContainer;
    }

    private function getMoodleEndContainer() {
        $moodleContainer = "</div></div></div>";
        return $moodleContainer;
    }

    private function getMoodleHeader($headerContent) {
        $moodleHeader = "<div class=\"modal-header\">
        <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
        <h4 class=\"modal-title\" >$headerContent</h4>
        </div>";
        return $moodleHeader;
    }

    private function getMoodleBody($bodyContent) {
        $moodlebody = "<div class=\"modal-body\">$bodyContent</div>";
        return $moodlebody;
    }

    public function getSidebar($data) {
        $sidebarImage = $this->sidebar["sidebar_image"];
        $sidebarHeading1 = $this->sidebar["sidebar_heading_1"];
        $sidebarHeading2 = $this->sidebar["sidebar_heading_2"];

        if (isset($data[$this->sidebar["sidebar_image"]])) {
            $sidebarImage = $data[$this->sidebar["sidebar_image"]];
        }
        if (isset($data[$this->sidebar["sidebar_heading_1"]])) {
            $sidebarHeading1 = $data[$this->sidebar["sidebar_heading_1"]];
        }
        if (isset($data[$this->sidebar["sidebar_heading_2"]])) {
            $sidebarHeading2 = $data[$this->sidebar["sidebar_heading_2"]];
        }

        if (isset($this->sidebar["sidebar_urls"])) {
            foreach ($this->sidebar["sidebar_urls"] as $urls) {
                $url = isset($urls['url']) ? $urls['url'] : "javascript:;";
                $icon = isset($urls['icon']) ? "<i class='" . $urls['icon'] . "'></i>" : "";
                $text = isset($urls['text']) ? $icon . $urls['text'] : $icon;
                $attr = isset($urls['attr']) ? $urls['attr'] : array();
                $anchorClass = isset($urls['class']) ? $urls['class'] : array();
                $data = isset($urls['data']) ? $this->getSpanField($urls['data'], array("pull-right", "sidebar_data")) : "";
                $text = $text . $data;
                $sidebar_url[] = $this->getAnchorField($text, $url, $attr, $anchorClass);
            }
        }
        return $this->pdocrudView->renderSidebar($sidebarImage, $sidebarHeading1, $sidebarHeading2, $sidebar_url, $this->settings, $this->objKey);
    }

    /**
     * Upload files using html file control. You can apply various restriction to make file uploading more secure.
     * @param   string  $fileName               file upload control
     * @param   string $fileUploadPath          Path to upload file
     * @param   int $maxSize                    Max size allowed, default is 10000000
     * @param   array $allowedFileTypes         Allowed file types
     *
     * return   boolean                         return true if file uploaded successfully else false
     */
    function fileUpload($fileName, $fileUploadPath = "", $maxSize = 10000000, $allowedFileTypes = array()) {
        if ($this->checkValidFileUpload($fileName, $fileUploadPath, $maxSize, $allowedFileTypes)) {
            if (!is_dir($fileUploadPath) && $fileUploadPath) {
                mkdir($fileUploadPath);
            }
            $destinationFileName = time() . "_" . $fileName["name"];
            $destinationPath = $fileUploadPath . $destinationFileName;
            if (move_uploaded_file($fileName["tmp_name"], $destinationPath)) {
                $destinationPath = $fileUploadPath . $destinationFileName;
                $fileExt = $this->getFileExtension($destinationPath);
                if (in_array($fileExt, array("jpg", "gif", "png"))) {
                    $newFileName = substr($destinationFileName, 0, strlen($destinationFileName) - strlen($fileExt) - 1);
                    require_once(dirname(__FILE__) . "/library/abeautifulsite/SimpleImage.php");
                    $img = new SimpleImage();
                    if (isset($this->imageDimensions)) {
                        foreach ($this->imageDimensions as $width => $height) {
                            $resizeImg = $newFileName . "_" . $width . "_" . $height . "." . $fileExt;
                            $newImage = $img->load($destinationPath)->resize($width, $height)->save($fileUploadPath . $resizeImg);
                        }
                    }

                    if (isset($this->watermark)) {
                        $img->load($destinationPath)->overlay($this->watermark["overlay"], $this->watermark["position"], $this->watermark["opacity"], $this->watermark["xOffset"], $this->watermark["yOffset"])->save($destinationPath);
                    }

                    if (isset($this->imageFlip)) {
                        $img->load($destinationPath)->flip($this->imageFlip)->save($destinationPath);
                    }

                    if (isset($this->imageThumbnail)) {
                        $img->load($destinationPath)->thumbnail($this->imageThumbnail["width"], $this->imageThumbnail["height"], $this->imageThumbnail["focal"])->save($destinationPath);
                    }

                    if (isset($this->imageCrop)) {
                        $img->load($destinationPath)->crop($this->imageCrop["x1"], $this->imageCrop["y1"], $this->imageCrop["x2"], $this->imageCrop["y2"])->save($destinationPath);
                    }

                    if (isset($this->imageText)) {
                        $imgText = $this->imageText;
                        $img->load($destinationPath)->text($imgText["text"], $imgText["font_file"], $imgText["font_size"], $imgText["color"], $imgText["position"], $imgText["x_offset"], $imgText["y_offset"], $imgText["stroke_color"], $imgText["stroke_size"], $imgText["alignment"], $imgText["letter_spacing"])->save($destinationPath);
                    }
                }
                return $this->settings["uploadURL"] . $destinationFileName;
            } else
                return false;
        }

        return false;
    }

    private function checkValidFileUpload($fileName, $fileUploadPath, $maxSize, $allowedFileTypes) {
        if (is_array($allowedFileTypes) && count($allowedFileTypes) > 0) {
            $fileExtensionLowerCase = strtolower($this->getFileExtension($fileName['name']));
            $fileExtensionUpperCase = strtoupper($this->getFileExtension($fileName['name']));
            if (!in_array($fileExtensionLowerCase, $allowedFileTypes) && !in_array($fileExtensionUpperCase, $allowedFileTypes)) {
                $this->addError($this->getLangData("valid_file"));
                return false;
            }
        }

        if ($fileName["size"] == 0) {
            $this->addError($this->getLangData("valid_file"));
            return false;
        }

        if ($fileName["size"] > $maxSize) {
            $this->addError($this->getLangData("max_file_size"));
            return false;
        }

        if ($fileName["error"] > 0) {
            $this->addError($fileName["error"]);
            return false;
        }

        return true;
    }

    /**
     * Returns a random key.
     */
    public function getRandomKey($allowSpecialChar = false) {
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        if ($allowSpecialChar)
            $alphabet .= "!@#$%&*";
        return substr(str_shuffle($alphabet), 0, 10);
    }

    /**
     * Returns array of files inside a directory
     */
    public function getDirFiles($dir, $extension = "") {
        try {
            $files = array_diff(scandir($dir), array(
                '..',
                '.'
            ));
            if (!empty($extension) && is_array($files) && count($files)) {
                $outputFiles = array();
                foreach ($files as $file) {
                    if ($this->getFileExtension($file) === $extension)
                        $outputFiles[] = $file;
                }
                $files = $outputFiles;
            }
        } catch (Exception $ex) {
            $this->addError($ex);
            return array();
        }
        return $files;
    }

    /**
     * Returns extention of file
     */
    private function getFileExtension($fileName) {
        return pathinfo($fileName, PATHINFO_EXTENSION);
    }

    /*     * *************************** Export functions ******************************************** */

    /**
     * Generates the csv file as output from the array provided. 
     * Returns true if operation performed successfully else return false.
     * 
     * @param   array     $csvArray             	Associative array with key as column name and value as table values.
     * @param   string    $outputFileName           Output csv file name
     *
     */
    public function arrayToCSV($csvArray, $outputFileName = "file.csv") {
        if (!is_array($csvArray)) {
            $this->addError($this->getLangData("valid_input"));
            return false;
        }
        if (!$outputFileName) {
            $this->addError($this->getLangData("valid_file_name"));
            return false;
        }
        if ($this->append && !isset($this->existingFilePath)) {
            $this->addError($this->getLangData("valid_existing_file"));
            return false;
        }
        $list = $csvArray;
        if ($this->fileSavePath && !is_dir($this->fileSavePath))
            mkdir($this->fileSavePath);

        if ($this->append)
            $fp = fopen($this->existingFilePath, 'a+');
        else
            $fp = fopen($this->fileSavePath . $outputFileName, 'w');

        foreach ($list as $fields) {
            fputcsv($fp, $fields, $this->delimiter, $this->enclosure);
        }

        if ($this->fileOutputMode == 'browser') {
            header("Content-type: application/csv");
            header("Content-Disposition: attachment; filename=" . $outputFileName);
            header("Pragma: no-cache");
            readfile($this->fileSavePath . $outputFileName);
            die(); //to prevent page output
        }

        fclose($fp);
        return $this->settings["downloadURL"] . $outputFileName;
    }

    /**
     * Generates the xml as output from the array provided. Returns true if operation performed successfully else return false
     * 
     * @param   array     $xmlArray             	Associative array with key as column name and value as table values.
     * @param   string    $outputFileName           Output xml file name
     *
     */
    public function arrayToXML($xmlArray, $outputFileName = "file.xml") {
        if (!is_array($xmlArray)) {
            $this->addError($this->getLangData("valid_input"));
            return false;
        }
        $xmlObject = new SimpleXMLElement("<?xml version=\"1.0\" encoding=\"$this->encoding\" ?><$this->rootElement></$this->rootElement>");
        $this->generateXML($xmlArray, $xmlObject, $this->rootElement);
        if ($this->fileOutputMode == "browser")
            echo $xmlObject->asXML();
        else {
            if ($this->fileSavePath && !is_dir($this->fileSavePath))
                mkdir($this->fileSavePath);
            $xmlObject->asXML($this->fileSavePath . $outputFileName);
            return $this->settings["downloadURL"] . $outputFileName;
        }
        return true;
    }

    /**
     * Generates the html table as output from the array provided.
     * 
     * @param   array     $htmlArray             	Associative array with key as column name and value as table values.
     * @param   array     $outputFileName           Output file name
     * @param   bool      $isCalledFromPDF          This function is used internally in arrayToPDF() also, to check whether it is called directly 			                                                    or using the pdf function 

     *
     */
    public function arrayToHTML($htmlArray, $outputFileName = "file.html", $isCalledFromPDF = false) {
        if (!is_array($htmlArray)) {
            $this->addError($this->getLangData("valid_input"));
            return false;
        }
        $table_output = '<table class="' . $this->tableCssClass . '" style="' . $this->htmlTableStyle . '">';
        $table_head = "";
        if ($this->useFirstRowAsTag == true)
            $table_head = "<thead>";
        $table_body = '<tbody>';
        $loop_count = 0;

        foreach ($htmlArray as $k => $v) {
            if ($this->useFirstRowAsTag == true && $loop_count == 0)
                $table_head .= '<tr class="' . $this->trCssClass . '" style="' . $this->htmlTRStyle . '" id="row_' . $loop_count . '">';
            else
                $table_body .= '<tr class="' . $this->trCssClass . '" style="' . $this->htmlTRStyle . '" id="row_' . $loop_count . '">';

            foreach ($v as $col => $row) {
                if ($this->useFirstRowAsTag == true && $loop_count == 0)
                    $table_head .= '<th style="' . $this->htmlTDStyle . '">' . $row . '</th>';
                else
                    $table_body .= '<td style="' . $this->htmlTDStyle . '">' . $row . '</td>';
            }
            $table_body .= '</tr>';
            if ($this->useFirstRowAsTag == true && $loop_count == 0)
                $table_body .= '</tr></thead>';

            $loop_count++;
        }

        $table_body .= '</tbody>';
        $table_output = $table_output . $table_head . $table_body . '</table>';
        $this->outputHTML = $table_output;
        if ($this->fileOutputMode == "save" && !$isCalledFromPDF) {
            if ($this->fileSavePath && !is_dir($this->fileSavePath))
                mkdir($this->fileSavePath);
            $fp = fopen($this->fileSavePath . $outputFileName, "w+");
            fwrite($fp, $table_output);
            fclose($fp);
            return $this->settings["downloadURL"] . $outputFileName;
        } else if ($this->fileOutputMode === 'browser' && !$isCalledFromPDF) {
            echo $table_output;
        }


        return true;
    }

    /**
     * Generates the pdf as output from the array provided. Returns true if operation performed successfully else return false
     * 
     * @param   array     $pdfArray             	Associative array with key as column name and value as table values.
     * @param   string    $outputFileName           Output pdf file name
     *
     */
    public function arrayToPDF($pdfArray, $outputFileName = "") {
        error_reporting(0);
        if (!is_array($pdfArray)) {
            $this->addError($this->getLangData("valid_input"));
            return false;
        }
        if (empty($outputFileName))
            $outputFileName = time() . ".pdf";

        require_once(dirname(__FILE__) . "/library/tcpdf/tcpdf.php");
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetFont($this->pdfFontName, $this->pdfFontWeight, $this->pdfFontSize, '', 'false');
        $pdf->SetAuthor($this->pdfAuthorName);
        $pdf->SetSubject($this->pdfSubject);
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        $pdf->AddPage();
        $this->arrayToHTML($pdfArray, "file.html", true);
        $pdf->writeHTML($this->outputHTML, true, false, true, false, '');
        if ($this->fileOutputMode == "browser")
            $pdf->Output($outputFileName, 'I');
        else {
            if ($this->fileSavePath && !is_dir($this->fileSavePath))
                mkdir($this->fileSavePath);
            $pdf->Output($this->fileSavePath . $outputFileName, 'F');
            return $this->settings["downloadURL"] . $outputFileName;
        }
        return true;
    }

    /**
     * Generates the excel file as output from the array provided. 
     * 
     * @param   array     $excelArray             	Associative array with key as column name and value as table values.
     * @param   string    $outputFileName           Output excel file name
     *
     */
    public function arrayToExcel($excelArray, $outputFileName = "file.xlsx") {
        if (!is_array($excelArray)) {
            $this->addError($this->getLangData("valid_input"));
            return false;
        }
        if ($this->append && !isset($this->existingFilePath)) {
            $this->addError($this->getLangData("valid_existing_file"));
            return false;
        }
        if (empty($outputFileName)) {
            if ($this->excelFormat == "2007")
                $outputFileName = "file.xlsx";
            else
                $outputFileName = "file.xls";
        }
        require_once(dirname(__FILE__) . "/library/PHPExcel/PHPExcel.php");

        if ($this->append) {
            require_once(dirname(__FILE__) . "/library/PHPExcel/PHPExcel/IOFactory.php");
            if (!file_exists($this->existingFilePath)) {
                $this->error = "Could not open " . $this->existingFilePath . " for reading! File does not exist.";
                return false;
            }
            $objPHPExcel = PHPExcel_IOFactory::load($this->existingFilePath);
        } else {
            $objPHPExcel = new PHPExcel();
        }
        $objPHPExcel->setActiveSheetIndex(0);

        $cells = array(
            "A",
            "B",
            "C",
            "D",
            "E",
            "F",
            "G",
            "H",
            "I",
            "J",
            "K",
            "L",
            "M",
            "N",
            "O",
            "P",
            "Q",
            "R",
            "S",
            "T",
            "U",
            "V",
            "W",
            "X",
            "Y",
            "Z"
        );
        $colCount = 1;

        if ($this->append)
            $colCount = $objPHPExcel->getActiveSheet()->getHighestRow() + 1;

        foreach ($excelArray as $rows) {
            $cellLoop = 0;
            foreach ($rows as $row) {
                $objPHPExcel->getActiveSheet()->setCellValue($cells[$cellLoop] . $colCount, $row);
                $cellLoop++;
            }
            $colCount++;
        }
        if ($this->excelFormat == "2007") {
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        } else {
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        }
        if ($this->append) {
            $objWriter->save($this->existingFilePath);
        } else {
            if ($this->fileOutputMode == "browser") {
                if ($this->excelFormat == "2007")
                    header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                else
                    header('Content-type: application/vnd.ms-excel');

                header('Content-Disposition: attachment; filename="' . $outputFileName . '"');
                $objWriter->save('php://output');
                die();
            } else {
                if ($this->fileSavePath && !is_dir($this->fileSavePath))
                    mkdir($this->fileSavePath);
                $objWriter->save($this->fileSavePath . $outputFileName);
                return $this->settings["downloadURL"] . $outputFileName;
            }
        }

        return true;
    }

    /*     * *************************** Import functions (added in version 1.9) ******************************************** */

    /**
     * Import data from csv/xml/excel file to database table directly. The key name(column name) must match the table column name to insert the 
     * data properly.
     * @param   string     $fileName                 Name or path of file.
     * @param   string     $tableName                Name of database table.
     *
     */
    public function bulkImport($fileName, $tableName) {
        $pdoModelObj = $this->getPDOModelObj();
        $filext = $this->getFileExtension($fileName);
        $records = array();

        if ($filext === "csv")
            $records = $this->csvToArray($fileName);
        else if ($filext === "xlsx" || $filext === "xls")
            $records = $this->excelToArray($fileName);
        else if ($filext === "xml")
            $records = $this->xmlToArray($fileName);

        $pdoModelObj->insertBatch($tableName, $records);
        return $pdoModelObj->rowsChanged;
    }

    /**
     * Returns the array as output from the csv provided.
     * 
     * @param   string     $fileName                 Name or path of csv file.
     *
     */
    public function csvToArray($fileName) {
        if (empty($fileName)) {
            $this->addError($this->getLangData("valid_input"));
            return false;
        }
        $csvArray = array();
        if (($handle = fopen($fileName, "r")) !== FALSE) {
            $rowIndex = 0;
            while (($lineArray = fgetcsv($handle, 0, $this->delimiter)) !== FALSE) {
                for ($colIndex = 0; $colIndex < count($lineArray); $colIndex++) {
                    $csvArray[$rowIndex][$colIndex] = $lineArray[$colIndex];
                }
                $rowIndex++;
            }
            fclose($handle);
        }
        $csvArray = $this->formatOutputArray($csvArray);
        return $csvArray;
    }

    /**
     * Returns the array as output from the excel provided.
     * 
     * @param   string     $fileName                 Name or path of excel file.
     */
    public function excelToArray($fileName) {
        if (!$fileName) {
            $this->addError($this->getLangData("valid_input"));
            return false;
        }
        require_once(dirname(__FILE__) . "/library/PHPExcel/PHPExcel/IOFactory.php");
        $objPHPExcel = PHPExcel_IOFactory::load($fileName);
        $excelArray = $objPHPExcel->getActiveSheet()->toArray(null, true, true, false);
        $excelArray = $this->formatOutputArray($excelArray);
        return $excelArray;
    }

    /**
     * Returns the array as output from the xml provided.
     * 
     * @param   string     $xmlSource                 Name or path of xml file.
     *
     */
    public function xmlToArray($xmlSource, $isFile = true) {
        if ($isFile)
            $xml = file_get_contents($xmlSource);
        else
            $xml = $xmlSource;

        $xmlObject = new SimpleXMLElement($xml);
        $decodeArray = @json_decode(@json_encode($xmlObject), 1);
        foreach ($decodeArray as $newDecodeArray) {
            $returnArray = $newDecodeArray;
        }
        return $returnArray;
    }

    private function formatOutputArray($data) {
        $output = array();
        $loop = 0;
        if (isset($data) && is_array($data) && count($data) > 0) {
            $columns = $data[0];
            foreach ($data as $row) {
                if ($loop > 0)
                    $output[] = array_combine($columns, $row);
                $loop++;
            }
        }
        return $output;
    }

    /*     * ********************************** Email Function *********************************************** */

    /**
     * Sends email using phpmailer 
     * @param   array  $to                List of receipient    
     * @param   string $subject           Subject of email
     * @param   string $message           Message of email
     * @param   array  $from              List of senders
     * @param   string $altMessage        For non html clients
     * @param   array  $cc                List of cc
     * @param   array  $bcc               List of bcc
     * @param   array  $attachments       List of attachments     
     * @param   string $mode              Send mail using php mail function or SMTP, default is phpmail function
     * @param   array  $smtp              SMTP authentication details if SMTP mode is used
     * @param   bool   isHTML             whether to send email as HTML email or not
     *
     * return   boolean                   return true if email function works properly
     */
    public function sendEmail($to, $subject, $message, $from = array(), $altMessage = "", $cc = array(), $bcc = array(), $attachments = array(), $mode = "PHPMAIL", $smtp = array(), $isHTML = true) {
        require_once(dirname(__FILE__) . "/library/PHPMailer-master/PHPMailerAutoload.php");
        $mail = new PHPMailer;
        $mail->Subject = $subject;
        $mail->msgHTML($message);
        $mail->AltBody = $message;
        $mailError = array();
        if (strtoupper($mode) === "SMTP") {
            $mail->isSMTP();
            $mail->Host = isset($smtp["host"]) ? $smtp["host"] : "";
            $mail->Port = isset($smtp["port"]) ? $smtp["port"] : 25;
            $mail->SMTPAuth = isset($smtp["SMTPAuth"]) ? $smtp["SMTPAuth"] : true;
            $mail->Username = isset($smtp["username"]) ? $smtp["username"] : "";
            $mail->Password = isset($smtp["password"]) ? $smtp["password"] : "";
            $mail->SMTPSecure = isset($smtp["SMTPSecure"]) ? $smtp["SMTPSecure"] : "";
            $mail->SMTPKeepAlive = isset($smtp["SMTPKeepAlive"]) ? $smtp["SMTPKeepAlive"] : true;
        }
        
        if (isset($from)) {
            if (is_array($from)) {
                foreach ($from as $key => $value) {
                    if (is_numeric($key))
                        $mail->setFrom($value, $value);
                    else
                        $mail->setFrom($key, $value);
                }
            }else{
                $mail->setFrom($from, $from);
            }
        }

        if (isset($cc)) {
            foreach ($cc as $key => $value) {
                if (is_numeric($key))
                    $mail->addCC($value, $value);
                else
                    $mail->addCC($key, $value);
            }
        }

        if (isset($bcc)) {
            foreach ($bcc as $key => $value) {
                if (is_numeric($key))
                    $mail->addBCC($value, $value);
                else
                    $mail->addBCC($key, $value);
            }
        }

        if (isset($attachments)) {
            foreach ($attachments as $attachment) {
                $mail->addAttachment($attachment);
            }
        }

        foreach ($to as $key => $value) {
            if (is_numeric($key))
                $mail->addAddress($value, $value);
            else
                $mail->addAddress($key, $value);

            if (!$mail->send()) {
                $mailError[] = $mail->ErrorInfo;
            }

            $mail->clearAddresses();
        }

        if (is_array($mailError) && count($mailError)) {
            foreach ($mailError as $err) {
                echo $err;
            }
        }

        return true;
    }

    private function generateXML($xmlArray, &$xmlObject, $rootElement = "root") {
        foreach ($xmlArray as $key => $value) {
            if (is_array($value)) {
                if (!is_numeric($key)) {
                    $subnode = $xmlObject->addChild("$key");
                    $this->generateXML($value, $subnode, $rootElement);
                } else {
                    $this->generateXML($value, $xmlObject, $rootElement);
                }
            } else {
                if (is_numeric($key)) {
                    $key = $rootElement;
                }
                $xmlObject->addChild("$key", "$value");
            }
        }
    }    
}