<?php

return array( 
    'plugins' => array(
        'melisModuleDiagnostics' => array(
            'conf' => array(
                // user rights exclusions
                'rightsDisplay' => 'none',
            ),
            'tools' => array(
                'melis_module_diagnostic_tool_config' => array(
                    'conf' => array(
                        'title' => 'tr_melis_module_diagnostics_title',
                        'id' => ''
                    ),
                ),
            ),
        ),
        'meliscore' => array(
            'tools' => array(
                'meliscore_tool_user' => array(
                    'conf' => array(
                        'title' => 'tr_meliscore_tool_user',
                        'id' => 'id_meliscore_tool_user_management',
                    ),
                    'table' => array(
                        // table ID
                        'target' => '#tableToolUserManagement',
                        'ajaxUrl' => '/melis/MelisCore/ToolUser/getUser',
                        'dataFunction' => '',
                        'ajaxCallback' => 'initRetrieveUser()', 
                        'filters' => array(
                            'left' => array(
                                'tooluser-limit' => array(
                                    'module' => 'MelisCore',
                                    'controller' => 'ToolUser',
                                    'action' => 'render-tool-user-content-filters-limit'
                                ),
                            ),
                            'center' => array(
                                'tooluser-search' => array(
                                    'module' => 'MelisCore',
                                    'controller' => 'ToolUser',
                                    'action' => 'render-tool-user-content-filters-search'
                                ),
                            ),
                            'right' => array(
                                'tooluser-export' => array(
                                    'module' => 'MelisCore',
                                    'controller' => 'ToolUser',
                                    'action' => 'render-tool-user-content-filters-export'
                                ),
                                'tooluser-refresh' => array(
                                    'module' => 'MelisCore',
                                    'controller' => 'ToolUser',
                                    'action' => 'render-tool-user-content-filters-refresh'
                                ),
                            ),
                        ),
                        'columns' => array(
                            'usr_id' => array(
                                'text' => 'tr_meliscore_tool_user_col_id',
                                'css' => array('width' => '1%', 'padding-right' => '0'),
                                'sortable' => true,
                                
                            ),
                            'usr_status' => array(
                                'text' => 'tr_meliscore_tool_user_col_status',
                                'css' => array('width' => '1%', 'padding-right' => '0'),
                                'sortable' => false,
                                
                            ),
                            'usr_image' => array(
                                'text' => 'tr_meliscore_tool_user_col_profile',
                                'css' => array('width' => '1%', 'padding-right' => '0'),
                                'sortable' => false,
                                
                            ),
                            'usr_login' => array(
                                'text' => 'tr_meliscore_tool_user_col_username',
                                'css' => array('width' => '21%', 'padding-right' => '0'),
                                'sortable' => true,
                                
                            ),
                            'usr_email' => array(
                                'text' => 'tr_meliscore_tool_user_col_Email',
                                'css' => array('width' => '20%', 'padding-right' => '0'),
                                'sortable' => true,
                                
                            ),
                            'usr_firstname' => array(
                                'text' => 'tr_meliscore_tool_user_col_name',
                                'css' => array('width' => '20%', 'padding-right' => '0'),
                                'sortable' => true,
                                
                            ),
                            'usr_last_login_date' => array(
                                'text' => 'tr_meliscore_tool_user_col_last_login',
                                'css' => array('width' => '20%', 'padding-right' => '0'),
                                'sortable' => true,
                                
                            ),
                        ),
                    
                        // define what columns can be used in searching
                        'searchables' => array('usr_id', 'usr_status', 'usr_login', 'usr_email','usr_firstname','usr_lastname','usr_last_login_date','usr_email'),
                        'actionButtons' => array(
                            'edit' => array(
                                'module' => 'MelisCore',
                                'controller' => 'ToolUser',
                                'action' => 'render-tool-user-content-action-edit',
                            ),
                            'delete' => array(
                                'module' => 'MelisCore',
                                'controller' => 'ToolUser',
                                'action' => 'render-tool-user-content-action-delete',
                            ),
                        )
                    ),
                    'export' => array(
                        'csvFileName' => 'meliscore_user_export.csv',  
                    ),


                    
                    'modals' => array(
                        'meliscore_tool_user_empty_modal' => array( // empty modal content
                            'id' => 'id_meliscore_tool_user_empty_modal',
                            'class' => 'glyphicons user',
                            'tab-header' => 'tr_meliscore_tool_user',
                            'tab-text' => 'tr_meliscore_tool_user_modal_empty',
                            'content' => array(
                                'module' => 'MelisCore',
                                'controller' => 'ToolUser',
                                'action' => 'render-tool-user-modal-empty'
                            ),
                        ),
                        'meliscore_tool_user_new_modal' => array( // add new user
                            'id' => 'id_meliscore_tool_user_new_modal',
                            'class' => 'glyphicons user',
                            'tab-header' => '',
                            'tab-text' => 'tr_meliscore_tool_user_new',
                            'content' => array(
                                'module' => 'MelisCore',
                                'controller' => 'ToolUser',
                                'action' => 'render-tool-user-modal-new'
                            ),
                        ),
                        'meliscore_tool_user_new_rights_modal' => array( // rights for the new user
                            'id' => 'id_meliscore_tool_user_new_rights_modal',
                            'class' => 'glyphicons user',
                            'tab-header' => '',
                            'tab-text' => 'tr_meliscore_tool_user_new_rights',
                            'content' => array(
                                'module' => 'MelisCore',
                                'controller' => 'ToolUser',
                                'action' => 'render-tool-user-modal-new-rights'
                            ),
                        ),
                        'meliscore_tool_user_edit_modal' => array( // edit user's information modal content
                            'id' => 'id_meliscore_tool_user_edit_modal',
                            'class' => 'glyphicons user',
                            'tab-header' => '',
                            'tab-text' => 'tr_meliscore_tool_user_modal_edit',
                            'content' => array(
                                'module' => 'MelisCore',
                                'controller' => 'ToolUser',
                                'action' => 'render-tool-user-modal-edit'
                            ),
                        ),
                        'meliscore_tool_user_rights_modal' => array( // rights modal content
                            'id' => 'id_meliscore_tool_user_rights_modal',
                            'class' => 'glyphicons user',
                            'tab-header' => '',
                            'tab-text' => 'tr_meliscore_tool_user_modal_rights',
                            'content' => array(
                                'module' => 'MelisCore',
                                'controller' => 'ToolUser',
                                'action' => 'render-tool-user-modal-rights'
                            ),
                        ),
                    ),
                    
                    'forms' => array(
                        'meliscore_tool_user_form_new' => array(
                            'attributes' => array(
                                'name' => 'newusermanagement',
                                'id' => 'idnewusermanagement',
                                'method' => 'POST',
                                'enctype' => 'multipart/form-data',
                                'action' => '',
                            ),
                            'hydrator'  => 'Zend\Stdlib\Hydrator\ArraySerializable',
                            'elements' => array(
                                array(
                                    'spec' => array(
                                        'name' => 'usr_login',
                                        'type' => 'MelisText',
                                        'options' => array(
                                            'label' => 'tr_meliscore_tool_user_col_username',
                                        ),
                                        'attributes' => array(
                                            'id' => 'id_n_usr_login',
                                            'value' => '',
                                            'placeholder' => 'tr_meliscore_tool_user_col_username'
                                        ),
                                    ),
                                ),
                                array(
                                    'spec' => array(
                                        'name' => 'usr_status',
                                        'type' => 'Zend\Form\Element\Select',
                                        'options' => array(
                                            'label' => 'tr_meliscore_tool_user_col_status',
                                            'empty_option' => 'tr_meliscore_common_choose',
                                            'value_options' => array(
                                                '0' => 'tr_meliscore_common_inactive',
                                                '1' => 'tr_meliscore_common_active',
                                            ),
                                        ),
                                        'attributes' => array(
                                            'id' => 'id_n_usr_status',
                                            'value' => '',
                                        ),
                                    ),
                                ),
                                array(
                                    'spec' => array(
                                        'name' => 'usr_email',
                                        'type' => 'MelisText',
                                        'options' => array(
                                            'label' => 'tr_meliscore_tool_user_col_Email',
                                        ),
                                        'attributes' => array(
                                            'id' => 'id_n_usr_email',
                                            'value' => '',
                                            'placeholder' => 'tr_meliscore_tool_user_col_Email'
                                        ),
                                    ),
                                ),
                                array(
                                    'spec' => array(
                                        'name' => 'usr_password',
                                        'type' => 'Password',
                                        'options' => array(
                                            'label' => 'tr_meliscore_tool_user_col_password',
                                            'label_options' => array(
                                                'disable_html_escape' => true,
                                            )
                                        ),
                                        'attributes' => array(
                                            'id' => 'id_n_usr_password',
                                            'value' => '',
                                            'placeholder' => 'tr_meliscore_tool_user_col_password',
                                            'class' => 'form-control',
                                        ),
                                    ),
                                ),
                                array(
                                    'spec' => array(
                                        'name' => 'usr_confirm_password',
                                        'type' => 'Password',
                                        'options' => array(
                                            'label' => 'tr_meliscore_tool_user_col_confirm_password',
                                            'label_options' => array(
                                                'disable_html_escape' => true,
                                            )
                                        ),
                                        'attributes' => array(
                                            'id' => 'id_n_usr_confirm_password',
                                            'value' => '',
                                            'placeholder' => 'tr_meliscore_tool_user_col_confirm_password',
                                            'class' => 'form-control',
                                        ),
                                    ),
                                ),
                                array(
                                    'spec' => array(
                                        'name' => 'usr_firstname',
                                        'type' => 'MelisText',
                                        'options' => array(
                                            'label' => 'tr_meliscore_tool_user_col_first_name',
                                        ),
                                        'attributes' => array(
                                            'id' => 'id_n_usr_firstname',
                                            'value' => '',
                                            'placeholder' => 'tr_meliscore_tool_user_col_first_name'
                                        ),
                                    ),
                                ),
                                array(
                                    'spec' => array(
                                        'name' => 'usr_lastname',
                                        'type' => 'MelisText',
                                        'options' => array(
                                            'label' => 'tr_meliscore_tool_user_col_last_name',
                                        ),
                                        'attributes' => array(
                                            'id' => 'id_n_usr_lastname',
                                            'value' => '',
                                            'placeholder' => 'tr_meliscore_tool_user_col_last_name'
                                        ),
                                    ),
                                ),
                                array(
                                    'spec' => array(
                                        'name' => 'usr_lang_id',
                                        'type' => 'MelisCoreLanguageSelect',
                                        'options' => array(
                                            'label' => 'tr_meliscore_tool_user_form_language',
                                            'empty_option' => 'tr_meliscore_common_choose',
                                            'disable_inarray_validator' => true,
                                        ),
                                        'attributes' => array(
                                            'id' => 'id_n_usr_lang_id',
                                        ),
                                    ),
                                ),
                                array(
                                    'spec' => array(
                                        'name' => 'usr_image',
                                        'type' => 'file',
                                        'options' => array(
                                            'label' => 'tr_meliscore_tool_user_col_profile',
                                        ),
                                        'attributes' => array(
                                            'id' => 'id_n_usr_image',
                                            'value' => '',
                                            'placeholder' => 'tr_meliscore_tool_user_col_profile',
                                            'onchange' => 'toolUserManagement.imagePreview("#new-profile-image", this);',
                                            'class' => 'filestyle',
                                            'data-buttonText' => 'Select Image',
                                        ),
                                    ),
                                ),
                                array(
                                    'spec' => array(
                                        'name' => 'usr_admin',
                                        'type' => 'MelisText',
                                        'options' => array(),
                                        'attributes' => array(
                                            'class' => 'usr_admin',
                                            'data-label' => 'tr_meliscore_tool_user_col_admin',
                                        ),
                                    ),
                                ),
                            ), // end elements
                            'input_filter' => array(
                                'usr_login' => array(
                                    'name'     => 'usr_login',
                                    'required' => true,
                                    'validators' => array(
                                        array(
                                            'name'    => 'StringLength',
                                            'options' => array(
                                                'encoding' => 'UTF-8',
                                                'max'      => 255,
                                                'messages' => array(
                                                    \Zend\Validator\StringLength::TOO_LONG => 'tr_meliscore_tool_user_usr_login_error_long',
                                                ),
                                            ),
                                        ),
                                        array(
                                            'name' => 'regex', false,
                                            'options' => array(
                                                'pattern' => '/^[a-zA-Z0-9]+([_ -]?[a-zA-Z0-9])*$/',
                                                'messages' => array(\Zend\Validator\Regex::NOT_MATCH => 'tr_meliscore_tool_user_usr_login_invalid'),
                                                'encoding' => 'UTF-8',
                                            ),
                                        ),
                                        array(
                                            'name' => 'NotEmpty',
                                            'options' => array(
                                                'messages' => array(
                                                    \Zend\Validator\NotEmpty::IS_EMPTY => 'tr_meliscore_tool_user_usr_login_error_empty',
                                                ),
                                            ),
                                        ),
                                    ),
                                    'filters'  => array(
                                        array('name' => 'StripTags'),
                                        array('name' => 'StringTrim'),
                                    ),
                                ),  
                                'usr_status' => array(
                                    'name'     => 'usr_status',
                                    'required' => true,
                                    'validators' => array(
                                        array(
                                            'name'    => 'InArray',
                                            'options' => array(
                                                'haystack' => array(1, 0),
                                                'messages' => array(
                                                    \Zend\Validator\InArray::NOT_IN_ARRAY => 'tr_meliscore_tool_user_usr_status_error_invalid',
                                                ),
                                            )
                                        ),
                                        array(
                                            'name' => 'NotEmpty',
                                            'options' => array(
                                                'messages' => array(
                                                    \Zend\Validator\NotEmpty::IS_EMPTY => 'tr_meliscore_tool_user_usr_status_error_empty',
                                                ),
                                            ),
                                        ),
                                    ),
                                    'filters'  => array(
                                    ),
                                ),

                                'usr_email' => array(
                                    'name'     => 'usr_email',
                                    'required' => true,
                                    'validators' => array(
                                        array(
                                            'name' => 'EmailAddress',
                                            'options' => array(
                                                'domain'   => 'true',
                                                'hostname' => 'true',
                                                'mx'       => 'true',
                                                'deep'     => 'true',
                                                'message'  => 'tr_meliscore_tool_user_invalid_email',
                                            )
                                        ),
                                        array(
                                            'name' => 'NotEmpty',
                                            'options' => array(
                                                'messages' => array(
                                                    \Zend\Validator\NotEmpty::IS_EMPTY => 'tr_meliscore_tool_user_usr_email_error_empty',
                                                ),
                                            ),
                                        ),
                                    ),
                                    'filters'  => array(
                                        array('name' => 'StripTags'),
                                        array('name' => 'StringTrim'),
                                    ),
                                ),
                                'usr_password' => array(
                                    'name'     => 'usr_password',
                                    'required' => true,
                                    'validators' => array(
                                        array(
                                            'name' => '\MelisCore\Validator\MelisPasswordValidator',
                                            'options' => array(
                                                'min' => 8,
                                                'messages' => array(
                                                    \MelisCore\Validator\MelisPasswordValidator::TOO_SHORT => 'tr_meliscore_tool_user_usr_password_error_low',
                                                    \MelisCore\Validator\MelisPasswordValidator::NO_DIGIT => 'tr_meliscore_tool_user_usr_password_regex_not_match',
                                                    \MelisCore\Validator\MelisPasswordValidator::NO_LOWER => 'tr_meliscore_tool_user_usr_password_regex_not_match',
                                                ),
                                            ),
                                        ),
                                        array(
                                            'name'    => 'StringLength',
                                            'options' => array(
                                                'encoding' => 'UTF-8',
                                                'max'      => 255,
                                                'messages' => array(
                                                    \Zend\Validator\StringLength::TOO_LONG => 'tr_meliscore_tool_user_usr_password_error_long',
                                                ),
                                            ),
                                        ),
                                        array(
                                            'name' => 'NotEmpty',
                                            'options' => array(
                                                'messages' => array(
                                                    \Zend\Validator\NotEmpty::IS_EMPTY => 'tr_meliscore_tool_user_usr_password_error_empty',
                                                ),
                                            ),
                                        ),
                                    ),
                                    'filters'  => array(
                                        array('name' => 'StripTags'),
                                        array('name' => 'StringTrim'),
                                    ),
                                ),
                                'usr_confirm_password' => array(
                                    'name'     => 'usr_confirm_password',
                                    'required' => true,
                                    'validators' => array(
                                        array(
                                            'name' => '\MelisCore\Validator\MelisPasswordValidator',
                                            'options' => array(
                                                'min' => 8,
                                                'messages' => array(
                                                    \MelisCore\Validator\MelisPasswordValidator::TOO_SHORT => 'tr_meliscore_tool_user_usr_confirm_password_error_low',
                                                    \MelisCore\Validator\MelisPasswordValidator::NO_DIGIT => 'tr_meliscore_tool_user_usr_password_regex_not_match',
                                                    \MelisCore\Validator\MelisPasswordValidator::NO_LOWER => 'tr_meliscore_tool_user_usr_password_regex_not_match',
                                                ),
                                            ),
                                        ),
                                        array(
                                            'name'    => 'StringLength',
                                            'options' => array(
                                                'encoding' => 'UTF-8',
                                                'max'      => 255,
                                                'messages' => array(
                                                    \Zend\Validator\StringLength::TOO_LONG => 'tr_meliscore_tool_user_usr_confirm_password_error_long',
                                                ),
                                            ),
                                        ),
                                        array(
                                            'name' => 'NotEmpty',
                                            'options' => array(
                                                'messages' => array(
                                                    \Zend\Validator\NotEmpty::IS_EMPTY => 'tr_meliscore_tool_user_usr_confirm_password_error_empty',
                                                ),
                                            ),
                                        ),
                                    ),
                                    'filters'  => array(
                                        array('name' => 'StripTags'),
                                        array('name' => 'StringTrim'),
                                    ),
                                ),
                                'usr_firstname' => array(
                                    'name'     => 'usr_firstname',
                                    'required' => true,
                                    'validators' => array(
                                        array(
                                            'name'    => 'StringLength',
                                            'options' => array(
                                                'encoding' => 'UTF-8',
                                                //'min'      => 1,
                                                'max'      => 255,
                                                'messages' => array(
                                                    \Zend\Validator\StringLength::TOO_LONG => 'tr_meliscore_tool_user_usr_firstname_error_long',
                                                ),
                                            ),
                                        ),
                                        array(
                                            'name' => 'regex', false,
                                            'options' => array(
                                                'pattern' => '/(\w)+/',
                                                'messages' => array(\Zend\Validator\Regex::NOT_MATCH => 'tr_meliscore_tool_user_usr_firstname_invalid'),
                                                'encoding' => 'UTF-8',
                                            ),
                                        ),
                                        array(
                                            'name' => 'NotEmpty',
                                            'options' => array(
                                                'messages' => array(
                                                    \Zend\Validator\NotEmpty::IS_EMPTY => 'tr_meliscore_tool_user_usr_firstname_error_empty',
                                                ),
                                            ),
                                        ),
                                    ),
                                    'filters'  => array(
                                        array('name' => 'StripTags'),
                                        array('name' => 'StringTrim'),
                                    ),
                                ),
                                'usr_lastname' => array(
                                    'name'     => 'usr_lastname',
                                    'required' => true,
                                    'validators' => array(
                                        array(
                                            'name'    => 'StringLength',
                                            'options' => array(
                                                'encoding' => 'UTF-8',
                                                'max'      => 255,
                                                'messages' => array(
                                                    \Zend\Validator\StringLength::TOO_LONG => 'tr_meliscore_tool_user_usr_lastname_error_long',
                                                ),
                                            ),
                                        ),
                                        array(
                                            'name' => 'regex', false,
                                            'options' => array(
                                                'pattern' => '/(\w)+/',
                                                'messages' => array(\Zend\Validator\Regex::NOT_MATCH => 'tr_meliscore_tool_user_usr_lastname_invalid'),
                                                'encoding' => 'UTF-8',
                                            ),
                                        ),
                                        array(
                                            'name' => 'NotEmpty',
                                            'options' => array(
                                                'messages' => array(
                                                    \Zend\Validator\NotEmpty::IS_EMPTY => 'tr_meliscore_tool_user_usr_lastname_error_empty',
                                                ),
                                            ),
                                        ),
                                    ),
                                    'filters'  => array(
                                        array('name' => 'StripTags'),
                                        array('name' => 'StringTrim'),
                                    ),
                                ),
                                'usr_lang_id' => array(
                                    'name'     => 'usr_lang_id',
                                    'required' => true,
                                    'validators' => array(
                                        array(
                                            'name'    => 'IsInt',
                                            'options' => array(
                                                'messages' => array(
                                                    \Zend\I18n\Validator\IsInt::NOT_INT => 'tr_meliscore_tool_user_usr_lang_id_error_invalid',
                                                    \Zend\I18n\Validator\IsInt::INVALID => 'tr_meliscore_tool_user_usr_lang_id_error_invalid',
                                                )
                                            )
                                        ),
                                        array(
                                            'name' => 'NotEmpty',
                                            'options' => array(
                                                'messages' => array(
                                                    \Zend\Validator\NotEmpty::IS_EMPTY => 'tr_meliscore_tool_user_usr_lang_id_error_empty',
                                                ),
                                            ),
                                        ),
                                    ),
                                    'filters'  => array(
                                    ),
                                ),
                            ), // end input filter
                        ), // end new user form
                        'meliscore_tool_user_form_edit' => array(
                            'attributes' => array(
                                'name' => 'usermanagement',
                                'id' => 'idusermanagement',
                                'method' => 'POST',
                                'enctype' => 'multipart/form-data',
                                'action' => '',
                            ),
                            'hydrator'  => 'Zend\Stdlib\Hydrator\ArraySerializable',
                            'elements' => array(
                                array(
                                    'spec' => array(
                                        'name' => 'usr_id',
                                        'type' => 'hidden',
                                        'options' => array(
                                            'label' => '',
                                        ),
                                        'attributes' => array(
                                            'id' => 'tool_user_management_id',
                                            'value' => '',
                                            //'disabled' => 'disabled',
                                        ),
                                    ),
                                ),
                                
                                array(
                                    'spec' => array(
                                        'name' => 'usr_login',
                                        'type' => 'MelisText',
                                        'options' => array(
                                            'label' => 'tr_meliscore_tool_user_col_username',
                                        ),
                                        'attributes' => array(
                                            'id' => 'tool_user_management_login',
                                            'value' => '',
                                            'disabled' => 'disabled',
                                        ),
                                    ),
                                ),
                                
                                array(
                                    'spec' => array(
                                        'name' => 'usr_status',
                                        'type' => 'Zend\Form\Element\Select',
                                        'options' => array(
                                            'label' => 'tr_meliscore_tool_user_col_status',
                                            'empty_option' => 'tr_meliscore_common_choose',
                                            'value_options' => array(
                                                '0' => 'tr_meliscore_common_inactive',
                                                '1' => 'tr_meliscore_common_active',
                                            ),
                                        ),
                                        'attributes' => array(
                                            'id' => 'id_usr_status',
                                            'value' => '',
                                        ),
                                    ),
                                ),
                                
                                array(
                                    'spec' => array(
                                        'name' => 'usr_email',
                                        'type' => 'MelisText',
                                        'options' => array(
                                            'label' => 'tr_meliscore_tool_user_col_Email',
                                        ),
                                        'attributes' => array(
                                            'id' => 'id_usr_email',
                                            'value' => '',
                                            'placeholder' => 'tr_meliscore_tool_user_col_Email'
                                        ),
                                    ),
                                ),
                                
                                array(
                                    'spec' => array(
                                        'name' => 'usr_password',
                                        'type' => 'Password',
                                        'options' => array(
                                            'label' => 'tr_meliscore_tool_user_col_password',
                                            'label_options' => array(
                                                'disable_html_escape' => true,
                                            )
                                        ),
                                        'attributes' => array(
                                            'id' => 'id_usr_password',
                                            'value' => '',
                                            'placeholder' => 'tr_meliscore_login_pass_placeholder',
                                            'class' => 'form-control',
                                        ),
                                    ),
                                ),
                                array(
                                    'spec' => array(
                                        'name' => 'usr_confirm_password',
                                        'type' => 'Password',
                                        'options' => array(
                                            'label' => 'tr_meliscore_tool_user_col_confirm_password',
                                            'label_options' => array(
                                                'disable_html_escape' => true,
                                            )
                                        ),
                                        'attributes' => array(
                                            'id' => 'id_usr_confirm_password',
                                            'value' => '',
                                            'placeholder' => 'tr_meliscore_login_pass_placeholder',
                                            'class' => 'form-control',
                                        ),
                                    ),
                                ),
                                
                                array(
                                    'spec' => array(
                                        'name' => 'usr_firstname',
                                        'type' => 'MelisText',
                                        'options' => array(
                                            'label' => 'tr_meliscore_tool_user_col_first_name',
                                        ),
                                        'attributes' => array(
                                            'id' => 'id_usr_firstname',
                                            'value' => '',
                                            'placeholder' => 'tr_meliscore_tool_user_col_first_name'
                                        ),
                                    ),
                                ),   
                                
                                array(
                                    'spec' => array(
                                        'name' => 'usr_lastname',
                                        'type' => 'MelisText',
                                        'options' => array(
                                            'label' => 'tr_meliscore_tool_user_col_last_name',
                                        ),
                                        'attributes' => array(
                                            'id' => 'id_usr_lastname',
                                            'value' => '',
                                            'placeholder' => 'tr_meliscore_tool_user_col_last_name'
                                        ),
                                    ),
                                ),
                                array(
                                    'spec' => array(
                                        'name' => 'usr_lang_id',
                                        'type' => 'MelisCoreLanguageSelect',
                                        'options' => array(
                                            'label' => 'tr_meliscore_tool_user_form_language',
                                            'empty_option' => 'tr_meliscore_common_choose',
                                            'disable_inarray_validator' => true,
                                        ),
                                        'attributes' => array(
                                            'id' => 'id_usr_lang_id',
                                        ),
                                    ),
                                ),
                                array(
                                    'spec' => array(
                                        'name' => 'usr_image',
                                        'type' => 'file',
                                        'options' => array(
                                            'label' => 'tr_meliscore_tool_user_col_profile',
                                        ),
                                        'attributes' => array(
                                            'id' => 'id_usr_image',
                                            'value' => '',
                                            'placeholder' => 'tr_meliscore_tool_user_col_profile',
                                            'onchange' => 'toolUserManagement.imagePreview("#profile-image", this);',
                                            'class' => 'filestyle',
                                            'data-buttonText' => 'Select Image',
                                        ),
                                    ),
                                ),
                                array(
                                    'spec' => array(
                                        'name' => 'usr_admin',
                                        'type' => 'MelisText',
                                        'options' => array(),
                                        'attributes' => array(
                                            'class' => 'usr_admin',
                                            'data-label' => 'tr_meliscore_tool_user_col_admin',
                                        ),
                                    ),
                                ),

                            ), // end edit elements
                            'input_filter' => array(
                                'usr_id' => array(
                                    'name'     => 'usr_id',
                                    'required' => false,
                                    'validators' => array(
                                        array(
                                            'name'    => 'IsInt',
                                            'options' => array(
                                                'messages' => array(
                                                    \Zend\I18n\Validator\IsInt::NOT_INT => 'tr_meliscore_tool_user_usr_id',
                                                    \Zend\I18n\Validator\IsInt::INVALID => 'tr_meliscore_tool_user_usr_id',
                                                )
                                            )
                                        ),
                                    ),
                                    'filters' => array(
                                        array('name' => 'StripTags'),
                                        array('name' => 'StringTrim'),
                                    ),
                                ),
                                'usr_status' => array(
                                    'name'     => 'usr_status',
                                    'required' => true,
                                    'validators' => array(
                                        array(
                                            'name'    => 'InArray',
                                            'options' => array(
                                                'haystack' => array(1, 0),
                                                'messages' => array(
                                                    \Zend\Validator\InArray::NOT_IN_ARRAY => 'tr_meliscore_tool_user_usr_status_error_invalid',
                                                ),
                                            )
                                        ),
                                        array(
                                            'name' => 'NotEmpty',
                                            'options' => array(
                                                'messages' => array(
                                                    \Zend\Validator\NotEmpty::IS_EMPTY => 'tr_meliscore_tool_user_usr_status_error_empty',
                                                ),
                                            ),
                                        ),
                                    ),
                                    'filters'  => array(
                                    ),
                                ),
                                'usr_email' => array(
                                    'name'     => 'usr_email',
                                    'required' => true,
                                    'validators' => array(
                                        array(
                                          'name' => 'EmailAddress',
                                           'options' => array(
                                               'domain'   => 'true',
                                               'hostname' => 'true',
                                               'mx'       => 'true',
                                               'deep'     => 'true',
                                               'message'  => 'tr_meliscore_tool_user_invalid_email',
                                           )
                                        ),
                                        array(
                                            'name' => 'NotEmpty',
                                            'options' => array(
                                                'messages' => array(
                                                    \Zend\Validator\NotEmpty::IS_EMPTY => 'tr_meliscore_tool_user_usr_email_error_empty',
                                                ),
                                            ),
                                        ),
                                    ),
                                    'filters'  => array(
                                        array('name' => 'StripTags'),
                                        array('name' => 'StringTrim'),
                                    ),
                                ),

                                
                                'usr_firstname' => array(
                                    'name'     => 'usr_firstname',
                                    'required' => true,
                                    'validators' => array(
                                        array(
                                            'name'    => 'StringLength',
                                            'options' => array(
                                                'encoding' => 'UTF-8',
                                                //'min'      => 1,
                                                'max'      => 255,
                                                'messages' => array(
                                                    \Zend\Validator\StringLength::TOO_LONG => 'tr_meliscore_tool_user_usr_firstname_error_long',
                                                ),
                                            ),
                                        ),
                                        array(
                                            'name' => 'regex', false,
                                            'options' => array(
                                                'pattern' => '/(\w)+/',
                                                'messages' => array(\Zend\Validator\Regex::NOT_MATCH => 'tr_meliscore_tool_user_usr_firstname_invalid'),
                                                'encoding' => 'UTF-8',
                                            ),
                                        ),
                                        array(
                                            'name' => 'NotEmpty',
                                            'options' => array(
                                                'messages' => array(
                                                    \Zend\Validator\NotEmpty::IS_EMPTY => 'tr_meliscore_tool_user_usr_firstname_error_empty',
                                                ),
                                            ),
                                        ),
                                    ),
                                    'filters'  => array(
                                        array('name' => 'StripTags'),
                                        array('name' => 'StringTrim'),
                                    ),
                                ),
                                'usr_lastname' => array(
                                    'name'     => 'usr_lastname',
                                    'required' => true,
                                    'validators' => array(
                                        array(
                                            'name'    => 'StringLength',
                                            'options' => array(
                                                'encoding' => 'UTF-8',
                                                //'min'      => 1,
                                                'max'      => 255,
                                                'messages' => array(
                                                    \Zend\Validator\StringLength::TOO_LONG => 'tr_meliscore_tool_user_usr_lastname_error_long',
                                                ),
                                            ),
                                        ),
                                        array(
                                            'name' => 'regex', false,
                                            'options' => array(
                                                'pattern' => '/(\w)+/',
                                                'messages' => array(\Zend\Validator\Regex::NOT_MATCH => 'tr_meliscore_tool_user_usr_lastname_invalid'),
                                                'encoding' => 'UTF-8',
                                            ),
                                        ),
                                        array(
                                            'name' => 'NotEmpty',
                                            'options' => array(
                                                'messages' => array(
                                                    \Zend\Validator\NotEmpty::IS_EMPTY => 'tr_meliscore_tool_user_usr_lastname_error_empty',
                                                ),
                                            ),
                                        ),
                                    ),
                                    'filters'  => array(
                                        array('name' => 'StripTags'),
                                        array('name' => 'StringTrim'),
                                    ),
                                ),
                                'usr_lang_id' => array(
                                    'name'     => 'usr_lang_id',
                                    'required' => true,
                                    'validators' => array(
                                        array(
                                            'name'    => 'IsInt',
                                            'options' => array(
                                                'messages' => array(
                                                    \Zend\I18n\Validator\IsInt::NOT_INT => 'tr_meliscore_tool_user_usr_lang_id_error_invalid',
                                                    \Zend\I18n\Validator\IsInt::INVALID => 'tr_meliscore_tool_user_usr_lang_id_error_invalid',
                                                )
                                            )
                                        ),
                                        array(
                                            'name' => 'NotEmpty',
                                            'options' => array(
                                                'messages' => array(
                                                    \Zend\Validator\NotEmpty::IS_EMPTY => 'tr_meliscore_tool_user_usr_lang_id_error_empty',
                                                ),
                                            ),
                                        ),
                                    ),
                                    'filters'  => array(
                                    ),
                                ),
                            ), // end input filter
                        ), // end edit form
                    ), // end forms
                ), // end user management tool
                // Platform Tool
                'meliscore_platform_tool' => array(
                    'conf' => array(
                        'title' => 'tr_meliscore_tool_platform_title',
                        'id' => 'id_meliscore_platform_tool',
                    ),
                    'table' => array(
                        'target' => '#tablePlatforms',
                        'ajaxUrl' => '/melis/MelisCore/Platforms/getPlatforms',
                        'dataFunction' => '',
                        'ajaxCallback' => 'getCurrentPlatform()',
                        'filters' => array(
                            'left' => array(
                                'platform_limit' => array(
                                    'module' => 'MelisCore',
                                    'controller' => 'Platforms',
                                    'action' => 'render-platform-content-filters-limit',
                                ),
                            ),
                            'center' => array(
                                'platform_search' => array(
                                    'module' => 'MelisCore',
                                    'controller' => 'Platforms',
                                    'action' => 'render-platform-content-filters-search',
                                ),
                            ),
                            'right' => array(
                                'platform_refresh' => array(
                                    'module' => 'MelisCore',
                                    'controller' => 'Platforms',
                                    'action' => 'render-platform-content-filters-refresh',
                                )
                            ),
                        ),
                        'columns' => array(
                            'plf_id' => array(
                                'text' => 'tr_meliscore_tool_platform_forms_id',
                                'css' => array('width' => '1%', 'padding-right' => '0'),
                                'sortable' => true,
                            ),
                            'plf_name' => array(
                                'text' => 'tr_meliscore_tool_platform_forms_name',
                                'css' => array('width' => '89%', 'padding-right' => '0'),
                                'sortable' => true,
                            ),
                        ),
                        'searchables' => array(
                            'plf_id',
                            'plf_name',
                        ),
                        'actionButtons' => array(
                            'platform_edit' => array(
                                'module' => 'MelisCore',
                                'controller' => 'Platforms',
                                'action' => 'render-platform-content-action-edit',
                            ),
                            'platform_delete' => array(
                                'module' => 'MelisCore',
                                'controller' => 'Platforms',
                                'action' => 'render-platform-content-action-delete',
                            )
                        ),
                        
                    ),
                    'modals' => array(
                        'meliscore_platform_modal_handler_empty' => array( // empty modal content
                            'id' => 'id_meliscore_platform_modal_handler_empty',
                            'class' => 'glyphicons remove',
                            'tab-header' => 'tr_meliscore_tool_user',
                            'tab-text' => 'tr_meliscore_tool_user_modal_empty',
                            'content' => array(
                                'module' => 'MelisCore',
                                'controller' => 'Platforms',
                                'action' => 'render-platform-modals-handler-empty'
                            ),
                        ),
                        'meliscore_platform_modal_content_new' => array(
                            'id' => 'id_meliscore_platform_modal_content_new',
                            'class' => 'glyphicons plus',
                            'tab-header' => '',
                            'tab-text' => 'tr_meliscore_tool_platform_modal_new',
                            'content' => array(
                                'module' => 'MelisCore',
                                'controller' => 'Platforms',
                                'action' => 'render-platform-modals-content-add'
                            ),
                        ),
                        'meliscore_platform_modal_content_edit' => array(
                            'id' => 'id_meliscore_platform_modal_content_edit',
                            'class' => 'glyphicons pencil',
                            'tab-header' => '',
                            'tab-text' => 'tr_meliscore_tool_platform_modal_edit',
                            'content' => array(
                                'module' => 'MelisCore',
                                'controller' => 'Platforms',
                                'action' => 'render-platform-modals-content-edit'
                            ),
                        ),
                    ),
                    'forms' => array(
                        'meliscore_platform_generic_form' => array(
                            'attributes' => array(
                                'name' => 'formsite',
                                'id' => 'idformsite',
                                'method' => 'POST',
                                'action' => '',
                            ),
                            'hydrator'  => 'Zend\Stdlib\Hydrator\ArraySerializable',
                            'elements' => array(
                                array(
                                    'spec' => array(
                                        'name' => 'plf_id',
                                        'type' => 'MelisText',
                                        'options' => array(
                                            'label' => 'tr_meliscore_tool_platform_forms_id',
                                        ),
                                        'attributes' => array(
                                            'id' => 'id_plf_id',
                                            'value' => '',
                                            'disabled' => 'disabled',
                                        ),
                                    ),
                                ),
                                array(
                                    'spec' => array(
                                        'name' => 'plf_name',
                                        'type' => 'MelisText',
                                        'options' => array(
                                            'label' => 'tr_meliscore_tool_platform_forms_name',
                                        ),
                                        'attributes' => array(
                                            'id' => 'id_plf_name',
                                            'value' => '',
                                        ),
                                    ),
                                ),
                            ),
                            'input_filter' => array(
                                'plf_id' => array(
                                    'name'     => 'plf_id',
                                    'required' => false,
                                    'validators' => array(
                                        array(
                                            'name'    => 'IsInt',
                                            'options' => array(
                                                'messages' => array(
                                                    \Zend\I18n\Validator\IsInt::NOT_INT => 'tr_meliscore_invalid_id',
                                                    \Zend\I18n\Validator\IsInt::INVALID => 'tr_meliscore_invalid_id',
                                                )
                                            )
                                        ),
                                    ),
                                    'filters' => array(
                                        array('name' => 'StripTags'),
                                        array('name' => 'StringTrim'),
                                    ),
                                ),
                                'plf_name' => array(
                                    'name'     => 'plf_name',
                                    'required' => true,
                                    'validators' => array(
                                        array(
                                            'name'    => 'StringLength',
                                            'options' => array(
                                                'encoding' => 'UTF-8',
                                                'max'      => 100,
                                                'messages' => array(
                                                    \Zend\Validator\StringLength::TOO_LONG => 'tr_meliscore_tool_platform_forms_name_long',
                                                ),
                                            ),
                                        ),
                                        array(
                                            'name' => 'NotEmpty',
                                            'options' => array(
                                                'messages' => array(
                                                    \Zend\Validator\NotEmpty::IS_EMPTY => 'tr_meliscore_tool_platform_forms_name_empty',
                                                ),
                                            ),
                                        ),
                                    ),
                                    'filters'  => array(
                                        array('name' => 'StripTags'),
                                        array('name' => 'StringTrim'),
                                    ),
                                ),
                            ),
                        ),
                    ),
                ),
                // end Platform tool
                
                // Language tool
                'meliscore_language_tool' => array(
                    'conf' => array(
                        'title' => 'tr_meliscore_tool_language',
                        'id' => 'id_meliscore_language_tool',
                    ), 
                    'table' => array(
                        'target' => '#tableLanguages',
                        'ajaxUrl' => '/melis/MelisCore/Language/getLanguages',
                        'dataFunction' => '',
                        'ajaxCallback' => 'initLangJs()',
                        'filters' => array(
                            'left' => array(
                                'meliscore_tool_language_content_filters_limit' => array(
                                    'module' => 'MelisCore',
                                    'controller' => 'Language',
                                    'action' => 'render-tool-language-content-filters-limit',
                                ),
                            ),
                            'center' => array(
                                'meliscore_tool_language_content_filters_search' => array(
                                    'module' => 'MelisCore',
                                    'controller' => 'Language',
                                    'action' => 'render-tool-language-content-filters-search',
                                ),
                            ),
                            'right' => array(
                                'meliscore_tool_language_content_filters_refresh' => array(
                                    'module' => 'MelisCore',
                                    'controller' => 'Language',
                                    'action' => 'render-tool-language-content-filters-refresh',
                                ),
                            ),
                        ),
                        'columns' => array(
                            'lang_id' => array(
                                'text' => 'tr_meliscore_tool_language_lang_id',
                                'css' => array('width' => '1%', 'padding-right' => '0'),
                                'sortable' => true,
                            ),
                            'lang_name' => array(
                                'text' => 'tr_meliscore_tool_language_lang_name',
                                'css' => array('width' => '49%', 'padding-right' => '0'),
                                'sortable' => true,
                            ),
                            'lang_locale' => array(
                                'text' => 'tr_meliscore_tool_language_lang_locale',
                                'css' => array('width' => '40%', 'padding-right' => '0'),
                                'sortable' => true,
                            ),
                        ),
                        'searchables' => array(
                            'lang_id', 'lang_locale', 'lang_name'
                        ),
                        'actionButtons' => array(
                            'meliscore_tool_language_content_apply' => array(
                                'module' => 'MelisCore',
                                'controller' => 'Language',
                                'action' => 'render-tool-language-content-action-apply',
                            ),
                            'meliscore_tool_language_content_update' => array(
                                'module' => 'MelisCore',
                                'controller' => 'Language',
                                'action' => 'render-tool-language-content-action-update',
                            ),
                            'meliscore_tool_language_content_delete' => array(
                                'module' => 'MelisCore',
                                'controller' => 'Language',
                                'action' => 'render-tool-language-content-action-delete',
                            ),
                        ),
                    ), // end table
                    'modals' => array(
                        'meliscore_tool_language_modal_content_empty' => array( // empty modal content
                            'id' => 'id_meliscore_tool_language_modal_content_empty',
                            'class' => 'glyphicons remove',
                            'tab-header' => 'tr_meliscore_tool_user',
                            'tab-text' => 'tr_meliscore_tool_user_modal_empty',
                            'content' => array(
                                'module' => 'MelisCore',
                                'controller' => 'Language',
                                'action' => 'render-tool-language-modal-empty-handler'
                            ),
                        ),
                        'meliscore_tool_language_modal_content_new' => array(
                            'id' => 'id_meliscore_tool_language_modal_content_new',
                            'class' => 'glyphicons plus',
                            'tab-header' => '',
                            'tab-text' => 'tr_meliscore_tool_language_new',
                            'content' => array(
                                'module' => 'MelisCore',
                                'controller' => 'Language',
                                'action' => 'render-tool-language-modal-add-content'
                            ),
                        ),
                    ), //end modals
                    'forms' => array(
                        'meliscore_tool_language_generic_form' => array(
                            'attributes' => array(
                                'name' => 'formlang',
                                'id' => 'idformlang',
                                'method' => 'POST',
                                'action' => '',
                            ),
                            'hydrator'  => 'Zend\Stdlib\Hydrator\ArraySerializable',
                            'elements' => array(
                                array(
                                    'spec' => array(
                                        'name' => 'lang_id',
                                        'type' => 'MelisText',
                                        'options' => array(
                                            //'label' => 'tr_meliscore_tool_language_lang_id',
                                        ),
                                        'attributes' => array(
                                            'id' => 'id_lang_id',
                                            'value' => '',
                                            'disabled' => 'disabled',
                                            'class' => 'hidden'
                                        ),
                                    ),
                                ),
                                array(
                                    'spec' => array(
                                        'name' => 'lang_name',
                                        'type' => 'MelisText',
                                        'options' => array(
                                            'label' => 'tr_meliscore_tool_language_lang_name',
                                        ),
                                        'attributes' => array(
                                            'id' => 'id_lang_name',
                                            'value' => '',
                                        ),
                                    ),
                                ),
                                array(
                                    'spec' => array(
                                        'name' => 'lang_locale',
                                        'type' => 'MelisText',
                                        'options' => array(
                                            'label' => 'tr_meliscore_tool_language_lang_locale',
                                        ),
                                        'attributes' => array(
                                            'id' => 'id_lang_locale',
                                            'value' => '',
                                        ),
                                    ),
                                ),

                            ),
                            'input_filter' => array(
                                'lang_id' => array(
                                    'name'     => 'lang_id',
                                    'required' => false,
                                    'validators' => array(
                                        array(
                                            'name'    => 'IsInt',
                                            'options' => array(
                                                'messages' => array(
                                                    \Zend\I18n\Validator\IsInt::NOT_INT => 'tr_meliscore_invalid_id',
                                                    \Zend\I18n\Validator\IsInt::INVALID => 'tr_meliscore_invalid_id',
                                                )
                                            )
                                        ),
                                    ),
                                    'filters' => array(
                                        array('name' => 'StripTags'),
                                        array('name' => 'StringTrim'),
                                    ),
                                ),
                                'lang_locale' => array(
                                    'name'     => 'lang_locale',
                                    'required' => true,
                                    'validators' => array(
                                        array(
                                            'name'    => 'StringLength',
                                            'options' => array(
                                                'encoding' => 'UTF-8',
                                                'max'      => 10,
                                                'messages' => array(
                                                    \Zend\Validator\StringLength::TOO_LONG => 'tr_meliscore_tool_language_lang_locale_long',
                                                ),
                                            ),
                                        ),
                                        array(
                                            'name' => 'NotEmpty',
                                            'options' => array(
                                                'messages' => array(
                                                    \Zend\Validator\NotEmpty::IS_EMPTY => 'tr_meliscore_tool_language_lang_locale_empty',
                                                ),
                                            ),
                                        ),
                                    ),
                                    'filters'  => array(
                                        array('name' => 'StripTags'),
                                        array('name' => 'StringTrim'),
                                    ),
                                ),
                                'lang_name' => array(
                                    'name'     => 'lang_name',
                                    'required' => true,
                                    'validators' => array(
                                        array(
                                            'name'    => 'StringLength',
                                            'options' => array(
                                                'encoding' => 'UTF-8',
                                                'max'      => 10,
                                                'messages' => array(
                                                    \Zend\Validator\StringLength::TOO_LONG => 'tr_meliscore_tool_language_lang_name_long',
                                                ),
                                            ),
                                        ),
                                        array(
                                            'name' => 'NotEmpty',
                                            'options' => array(
                                                'messages' => array(
                                                    \Zend\Validator\NotEmpty::IS_EMPTY => 'tr_meliscore_tool_language_lang_name_empty',
                                                ),
                                            ),
                                        ),
                                    ),
                                    'filters'  => array(
                                        array('name' => 'StripTags'),
                                        array('name' => 'StringTrim'),
                                    ),
                                ),
                            ),
                        ),
                    ), // end form
                ),
                // end Language tool
                // Email Management Tool
                'meliscore_emails_mngt_tool' => array(
                    'conf' => array(
                        'title' => 'tr_meliscore_email_mngt_tool',
                        'id' => 'id_meliscore_email_mngt_tool',
                    ),
                    'conf' => array(
                        'title' => 'tr_meliscore_tool_language',
                        'id' => 'id_meliscore_language_tool',
                    ),
                    'table' => array(
                        'target' => '#tableEmailMngt',
                        'ajaxUrl' => '/melis/MelisCore/EmailsManagement/getEmailsEntries',
                        'dataFunction' => '',
                        'ajaxCallback' => 'reInitTableEmailMngt();',
                        'filters' => array(
                            'left' => array(
                                'meliscore_tool_language_content_filters_limit' => array(
                                    'module' => 'MelisCore',
                                    'controller' => 'Language',
                                    'action' => 'render-tool-language-content-filters-limit',
                                ),
                            ),
                            'center' => array(
                                'meliscore_tool_tool_emails_mngt_table_search' => array(
                                    'module' => 'MelisCore',
                                    'controller' => 'EmailsManagement',
                                    'action' => 'render-tool-emails-mngt-table-search',
                                ),
                            ),
                            'right' => array(
                                'meliscore_tool_tool_emails_mngt_table_refresh' => array(
                                    'module' => 'MelisCore',
                                    'controller' => 'EmailsManagement',
                                    'action' => 'render-tool-emails-mngt-table-refresh',
                                ),
                            ),
                        ),
                        'columns' => array(
                            'boe_id' => array(
                                'text' => 'tr_meliscore_tool_email_mngt_boe_id',
                                'css' => array('width' => '1%', 'padding-right' => '0'),
                                'sortable' => true,
                            ),
                            'boe_indicator' => array(
                                'text' => 'tr_meliscore_tool_email_mngt_boe_indicator',
                                'css' => array('width' => '3%', 'padding-right' => '0'),
                                'sortable' => true,
                            ),
                            'boe_name' => array(
                                'text' => 'tr_meliscore_tool_email_mngt_boe_name',
                                'css' => array('width' => '16%', 'padding-right' => '0'),
                                'sortable' => true,
                            ),
                            'boe_code_name' => array(
                                'text' => 'tr_meliscore_tool_email_mngt_boe_code_name',
                                'css' => array('width' => '15%', 'padding-right' => '0'),
                                'sortable' => true,
                            ),
                            'boe_lang' => array(
                                'text' => 'tr_meliscore_tool_email_mngt_boe_lang',
                                'css' => array('width' => '15%', 'padding-right' => '0'),
                                'sortable' => true,
                            ),
                            'boe_from_name' => array(
                                'text' => 'tr_meliscore_tool_email_mngt_boe_from_name',
                                'css' => array('width' => '20%', 'padding-right' => '0'),
                                'sortable' => true,
                            ),
                            'boe_from_email' => array(
                                'text' => 'tr_meliscore_tool_email_mngt_boe_from_email',
                                'css' => array('width' => '10%', 'padding-right' => '0'),
                                'sortable' => true,
                            ),
                            'boe_reply_to' => array(
                                'text' => 'tr_meliscore_tool_email_mngt_boe_reply_to',
                                'css' => array('width' => '10%', 'padding-right' => '0'),
                                'sortable' => true,
                            ),
                        ),
                        'searchables' => array(
                            'boe_id', 'boe_name', 'boe_code_name'
                        ),
                        'actionButtons' => array(
                            'meliscore_tool_language_content_apply' => array(
                                'module' => 'MelisCore',
                                'controller' => 'EmailsManagement',
                                'action' => 'render-tool-emails-mngt-content-action-edit',
                            ),
                            'meliscore_tool_language_content_delete' => array(
                                'module' => 'MelisCore',
                                'controller' => 'EmailsManagement',
                                'action' => 'render-tool-emails-mngt-content-action-delete',
                            ),
                        ),
                    ), // end table 
                    'forms' => array(
                        'meliscore_emails_mngt_tool_general_properties_form' => array(
                            'attributes' => array(
                                'name' => 'generalPropertiesForm',
                                'id' => 'idGeneralPropertiesForm',
                                'method' => 'POST',
                                'action' => '',
                            ),
                            'hydrator'  => 'Zend\Stdlib\Hydrator\ArraySerializable',
                            'elements' => array(
                                array(
                                    'spec' => array(
                                        'name' => 'boe_name',
                                        'type' => 'MelisText',
                                        'options' => array(
                                            'label' => 'tr_meliscore_emails_mngt_tool_general_properties_form_boe_name',
                                        ),
                                        'attributes' => array(
                                            'id' => 'boe_name',
                                        ),
                                    ),
                                ),
                                array(
                                    'spec' => array(
                                        'name' => 'boe_code_name',
                                        'type' => 'MelisText',
                                        'options' => array(
                                            'label' => 'tr_meliscore_emails_mngt_tool_general_properties_form_boe_code_name',
                                        ),
                                        'attributes' => array(
                                            'id' => 'boe_code_name',
                                        ),
                                    ),
                                ),
                                array(
                                    'spec' => array(
                                        'name' => 'boe_from_name',
                                        'type' => 'MelisText',
                                        'options' => array(
                                            'label' => 'tr_meliscore_emails_mngt_tool_general_properties_form_boe_from_name',
                                        ),
                                        'attributes' => array(
                                            'id' => 'boe_code_name',
                                        ),
                                    ),
                                ),
                                array(
                                    'spec' => array(
                                        'name' => 'boe_from_email',
                                        'type' => 'MelisText',
                                        'options' => array(
                                            'label' => 'tr_meliscore_emails_mngt_tool_general_properties_form_boe_from_email',
                                        ),
                                        'attributes' => array(
                                            'id' => 'boe_from_email',
                                        ),
                                    ),
                                ),
                                array(
                                    'spec' => array(
                                        'name' => 'boe_reply_to',
                                        'type' => 'MelisText',
                                        'options' => array(
                                            'label' => 'tr_meliscore_emails_mngt_tool_general_properties_form_boe_reply_to',
                                        ),
                                        'attributes' => array(
                                            'id' => 'boe_reply_to',
                                        ),
                                    ),
                                ),
                                array(
                                    'spec' => array(
                                        'name' => 'boe_tag_accepted_list',
                                        'type' => 'MelisCoreMultiValInput',
                                        'attributes' => array(
                                            'id' => 'boe_tag_accepted_list',
                                            'data-label-text' => 'tr_meliscore_emails_mngt_tool_general_properties_form_boe_tag_accepted_list',
                                            'placeholder' => 'tr_meliscore_emails_mngt_tool_general_properties_form_boe_tag_accepted_list_placeholder',
                                        ),
                                    ),
                                ),
                                array(
                                    'spec' => array(
                                        'name' => 'boe_content_layout',
                                        'type' => 'MelisText',
                                        'options' => array(
                                            'label' => 'tr_meliscore_emails_mngt_tool_general_properties_form_boe_content_layout',
                                        ),
                                        'attributes' => array(
                                            'id' => 'boe_content_layout',
                                        ),
                                    ),
                                ),
                            ),
                            'input_filter' => array(
                                'boe_name' => array(
                                    'name'     => 'boe_name',
                                    'required' => true,
                                    'validators' => array(
                                        array(
                                            'name' => 'NotEmpty',
                                            'options' => array(
                                                'messages' => array(
                                                    \Zend\Validator\NotEmpty::IS_EMPTY => 'tr_meliscore_emails_mngt_tool_general_properties_form_empty',
                                                ),
                                            ),
                                        ),
                                        array(
                                            'name'    => 'StringLength',
                                            'options' => array(
                                                'encoding' => 'UTF-8',
                                                'max'      => 255,
                                                'messages' => array(
                                                    \Zend\Validator\StringLength::TOO_LONG => 'tr_meliscore_emails_mngt_tool_general_properties_form_long',
                                                ),
                                            ),
                                        ),
                                    ),
                                    'filters'  => array(
                                        array('name' => 'StripTags'),
                                        array('name' => 'StringTrim'),

                                    ),
                                ),
                                'boe_code_name' => array(
                                    'name'     => 'boe_code_name',
                                    'required' => true,
                                    'validators' => array(
                                        array(
                                            'name' => 'NotEmpty',
                                            'options' => array(
                                                'messages' => array(
                                                    \Zend\Validator\NotEmpty::IS_EMPTY => 'tr_meliscore_emails_mngt_tool_general_properties_form_empty',
                                                ),
                                            ),
                                        ),
                                        array(
                                            'name' => 'regex', false,
                                            'options' => array(
                                                'pattern' => '/[\w]+/',
                                                'messages' => array(\Zend\Validator\Regex::INVALID => 'tr_emails_management_emal_boe_code_name_invalid'),
                                                'encoding' => 'UTF-8',
                                            ),
                                        ),
                                        array(
                                            'name'    => 'StringLength',
                                            'options' => array(
                                                'encoding' => 'UTF-8',
                                                'max'      => 255,
                                                'messages' => array(
                                                    \Zend\Validator\StringLength::TOO_LONG => 'tr_meliscore_emails_mngt_tool_general_properties_form_long',
                                                ),
                                            ),
                                        ),
                                    ),
                                    'filters'  => array(
                                        array('name' => 'StripTags'),
                                        array('name' => 'StringTrim'),
                                    ),
                                ),
                                'boe_from_name' => array(
                                    'name'     => 'boe_from_name',
                                    'required' => true,
                                    'validators' => array(
                                        array(
                                            'name' => 'NotEmpty',
                                            'options' => array(
                                                'messages' => array(
                                                    \Zend\Validator\NotEmpty::IS_EMPTY => 'tr_meliscore_emails_mngt_tool_general_properties_form_empty',
                                                ),
                                            ),
                                        ),
                                        array(
                                            'name'    => 'StringLength',
                                            'options' => array(
                                                'encoding' => 'UTF-8',
                                                'max'      => 255,
                                                'messages' => array(
                                                    \Zend\Validator\StringLength::TOO_LONG => 'tr_meliscore_emails_mngt_tool_general_properties_form_long',
                                                ),
                                            ),
                                        ),
                                    ),
                                    'filters'  => array(
                                        array('name' => 'StripTags'),
                                        array('name' => 'StringTrim'),
                                    ),
                                ),
                                'boe_from_email' => array(
                                    'name'     => 'boe_from_email',
                                    'required' => true,
                                    'validators' => array(
                                        array(
                                            'name'    => 'EmailAddress',
                                            'options' => array(
                                                'domain'   => 'true',
                                                'hostname' => 'true',
                                                'mx'       => 'true',
                                                'deep'     => 'true',
                                                'message'  => 'tr_meliscore_emails_mngt_tool_general_properties_form_invalid_email',
                                            )
                                        ),
                                        array(
                                            'name' => 'NotEmpty',
                                            'options' => array(
                                                'messages' => array(
                                                    \Zend\Validator\NotEmpty::IS_EMPTY => 'tr_meliscore_emails_mngt_tool_general_properties_form_empty',
                                                ),
                                            ),
                                        ),
                                        array(
                                            'name'    => 'StringLength',
                                            'options' => array(
                                                'encoding' => 'UTF-8',
                                                'max'      => 255,
                                                'messages' => array(
                                                    \Zend\Validator\StringLength::TOO_LONG => 'tr_meliscore_emails_mngt_tool_general_properties_form_long',
                                                ),
                                            ),
                                        ),
                                    ),
                                    'filters'  => array(
                                        array('name' => 'StripTags'),
                                        array('name' => 'StringTrim'),
                                    ),
                                ),
                                'boe_reply_to' => array(
                                    'name'     => 'boe_reply_to',
                                    'required' => false,
                                    'validators' => array(
                                        array(
                                            'name'    => 'EmailAddress',
                                            'options' => array(
                                                'domain'   => 'true',
                                                'hostname' => 'true',
                                                'mx'       => 'true',
                                                'deep'     => 'true',
                                                'message'  => 'tr_meliscore_emails_mngt_tool_general_properties_form_invalid_email',
                                            )
                                        ),
                                        array(
                                            'name'    => 'StringLength',
                                            'options' => array(
                                                'encoding' => 'UTF-8',
                                                'max'      => 255,
                                                'messages' => array(
                                                    \Zend\Validator\StringLength::TOO_LONG => 'tr_meliscore_emails_mngt_tool_general_properties_form_long',
                                                ),
                                            ),
                                        ),
                                    ),
                                    'filters'  => array(
                                        array('name' => 'StripTags'),
                                        array('name' => 'StringTrim'),
                                    ),
                                ),
                                'boe_content_layout' => array(
                                    'name'     => 'boe_content_layout',
                                    'required' => false,
                                    'validators' => array(
                                        array(
                                            'name'    => 'StringLength',
                                            'options' => array(
                                                'encoding' => 'UTF-8',
                                                'max'      => 255,
                                                'messages' => array(
                                                    \Zend\Validator\StringLength::TOO_LONG => 'tr_meliscore_emails_mngt_tool_general_properties_form_long',
                                                ),
                                            ),
                                        ),
                                    ),
                                    'filters'  => array(
                                        array('name' => 'StripTags'),
                                        array('name' => 'StringTrim'),
                                    ),
                                ),
                            ),
                        ),
                        'meliscore_emails_mngt_tool_emails_details_form' => array(
                            'attributes' => array(
                                'name' => 'emailsDetailsForm',
                                'id' => 'idemailsDetailsForm',
                                'method' => 'POST',
                                'action' => '',
                            ),
                            'hydrator'  => 'Zend\Stdlib\Hydrator\ArraySerializable',
                            'elements' => array(
                                array(
                                    'spec' => array(
                                        'name' => 'boed_id',
                                        'type' => 'MelisText',
                                        'attributes' => array(
                                            'id' => 'boed_id',
                                            'class' => 'hidden',
                                        ),
                                    ),
                                ),
                                array(
                                    'spec' => array(
                                        'name' => 'boed_subject',
                                        'type' => 'MelisText',
                                        'options' => array(
                                            'label' => 'tr_meliscore_emails_mngt_tool_emails_details_form_boed_subject',
                                        ),
                                        'attributes' => array(
                                            'id' => 'boe_from_name',
                                            'value' => '',
                                        ),
                                    ),
                                ),
                                array(
                                    'spec' => array(
                                        'name' => 'boed_html',
                                        'type' => 'TextArea',
                                        'options' => array(
                                            'label' => 'tr_meliscore_emails_mngt_tool_emails_details_form_boed_html',
                                        ),
                                        'attributes' => array(
                                            'class' => 'form-control',
                                            'rows' => 10,
                                        ),
                                    ),
                                ),
                                array(
                                    'spec' => array(
                                        'name' => 'boed_text',
                                        'type' => 'TextArea',
                                        'options' => array(
                                            'label' => 'tr_meliscore_emails_mngt_tool_emails_details_form_boed_text',
                                        ),
                                        'attributes' => array(
                                            'class' => 'form-control',
                                            'rows' => 10,
                                        ),
                                    ),
                                ),
                            ),
                            // filter here
                        )
                    )
                ),
                // End of Email Management Tool
                
                // Logs tool
                'meliscore_logs_tool' => array(
                    'conf' => array(
                        'title' => 'tr_meliscore_logs_tool',
                        'id' => 'id_meliscore_logs_tool',
                    ),
                    'table' => array(
                        'target' => '#tableMelisLogs',
                        'ajaxUrl' => '/melis/MelisCore/Log/getLogs',
                        'dataFunction' => 'initLogDataTable',
                        'ajaxCallback' => '',
                        'initComplete' => 'initDatePicker()',
                        'filters' => array(
                            'left' => array(
                                'meliscore_logs_tool_table_limit' => array(
                                    'module' => 'MelisCore',
                                    'controller' => 'Log',
                                    'action' => 'render-logs-tool-table-limit',
                                ),
                                'meliscore_logs_tool_table_date_range' => array(
                                    'module' => 'MelisCore',
                                    'controller' => 'Log',
                                    'action' => 'render-logs-tool-table-date-range',
                                ),
                            ),
                            'center' => array(
                                'meliscore_logs_tool_table_search' => array(
                                    'module' => 'MelisCore',
                                    'controller' => 'Log',
                                    'action' => 'render-logs-tool-table-search',
                                ),
                                'meliscore_logs_tool_table_user_filter' => array(
                                    'module' => 'MelisCore',
                                    'controller' => 'Log',
                                    'action' => 'render-logs-tool-table-user-filter',
                                ),
                            ),
                            'right' => array(
                                'meliscore_logs_tool_table_type_filter' => array(
                                    'module' => 'MelisCore',
                                    'controller' => 'Log',
                                    'action' => 'render-logs-tool-table-type-filter',
                                ),
                                'meliscore_logs_tool_table_refresh' => array(
                                    'module' => 'MelisCore',
                                    'controller' => 'Log',
                                    'action' => 'render-logs-tool-table-refresh',
                                ),
                            ),
                        ),
                        'columns' => array(
                            'log_id' => array(
                                'text' => 'tr_meliscore_logs_tool_log_id',
                                'css' => array('width' => '1%'),
                                'sortable' => true,
                            ),
                            'log_title' => array(
                                'text' => 'tr_meliscore_logs_tool_log_title',
                                'css' => array('width' => '20%'),
                                'sortable' => false,
                            ),
                            'log_message' => array(
                                'text' => 'tr_meliscore_logs_tool_log_message',
                                'css' => array('width' => '30%'),
                                'sortable' => false,
                            ),
                            'log_user' => array(
                                'text' => 'tr_meliscore_logs_tool_log_user',
                                'css' => array('width' => '15%'),
                                'sortable' => false,
                            ),
                            'log_type' => array(
                                'text' => 'tr_meliscore_logs_tool_log_type',
                                'css' => array('width' => '15%'),
                                'sortable' => false,
                            ),
                            'log_item_id' => array(
                                'text' => 'tr_meliscore_logs_tool_log_item_id',
                                'css' => array('width' => '5%'),
                                'sortable' => false,
                            ),
                            'log_date_added' => array(
                                'text' => 'tr_meliscore_logs_tool_log_date_added',
                                'css' => array('width' => '15%'),
                                'sortable' => false,
                            ),
                        ),
                        'searchables' => array(),
                        'actionButtons' => array(),
                    ),
                    'forms' => array(
                        'meliscore_logs_tool_log_type_form' => array(
                            'attributes' => array(
                                'name' => 'logTypeForm',
                                'id' => '',
                                'method' => '',
                                'action' => '',
                                'class' => 'logTypeForm',
                            ),
                            'hydrator'  => 'Zend\Stdlib\Hydrator\ArraySerializable',
                            'elements' => array(
                                array(
                                    'spec' => array(
                                        'name' => 'logtt_id',
                                        'type' => 'hidden',
                                    ),
                                ),
                                array(
                                    'spec' => array(
                                        'name' => 'logtt_lang_id',
                                        'type' => 'hidden',
                                    ),
                                ),
                                array(
                                    'spec' => array(
                                        'name' => 'logtt_type_id',
                                        'type' => 'hidden',
                                    ),
                                ),
                                array(
                                    'spec' => array(
                                        'name' => 'logtt_name',
                                        'type' => 'MelisText',
                                        'options' => array(
                                            'label' => 'tr_meliscore_logs_tool_log_type_name',
                                        ),
                                        'attributes' => array(
                                            'id' => 'logtt_name',
                                        ),
                                    ),
                                ),
                                array(
                                    'spec' => array(
                                        'name' => 'logtt_description',
                                        'type' => 'Textarea',
                                        'options' => array(
                                            'label' => 'tr_meliscore_logs_tool_log_type_description',
                                        ),
                                        'attributes' => array(
                                            'id' => 'logtt_name',
                                            'rows' => 10,
                                            'class' => 'form-control',
                                        ),
                                    ),
                                ),
                                
                            ),
                            'input_filter' => array(
                                'logtt_name' => array(
                                    'name'     => 'logtt_name',
                                    'required' => false,
                                    'validators' => array(
                                        array(
                                            'name'    => 'StringLength',
                                            'options' => array(
                                                'encoding' => 'UTF-8',
                                                'max'      => 255,
                                                'messages' => array(
                                                    \Zend\Validator\StringLength::TOO_LONG => 'tr_meliscore_logs_tool_log_input_to_long_255',
                                                ),
                                            ),
                                        ),
                                    ),
                                    'filters'  => array(
                                        array('name' => 'StripTags'),
                                        array('name' => 'StringTrim'),
                                    ),
                                ),
                                'logtt_description' => array(
                                    'name'     => 'logtt_description',
                                    'required' => false,
                                    'validators' => array(
                                        array(
                                            'name'    => 'StringLength',
                                            'options' => array(
                                                'encoding' => 'UTF-8',
                                                'max'      => 255,
                                                'messages' => array(
                                                    \Zend\Validator\StringLength::TOO_LONG => 'tr_meliscore_logs_tool_log_input_to_long_255',
                                                ),
                                            ),
                                        ),
                                    ),
                                    'filters'  => array(
                                        array('name' => 'StripTags'),
                                        array('name' => 'StringTrim'),
                                    ),
                                ),
                            )
                        )
                    ),
                ),
                // end Language tool
             ),
        ),
    ),
);