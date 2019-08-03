<?php

# Copyright (c) 2019 Scott Meesseman
# Licensed under GPL3 

class ProjectPagesPlugin extends MantisPlugin
{
    public function register()
    {
        $this->name = plugin_lang_get("title");
        $this->description = plugin_lang_get("description");
        //$this->page = 'config_page';

        $this->version = "1.1.3";
        $this->requires = array(
            "MantisCore" => "2.0.0"
        );

        $this->author = "Scott Meesseman";
        $this->contact = "spmeesseman@gmail.com";
        $this->url = "https://github.com/mantisbt-plugins/ProjectPages";
    }

    public function hooks()
    {
        return array(
            "EVENT_MENU_MAIN_FRONT" => "menuFront",
            "EVENT_MENU_MAIN" => "menuBack"
        );
    }

    public function menuFront()
    {
        $options = plugin_config_get('main_menu_options_front');
        $project_id = helper_get_current_project();
        $project_name = project_get_name($project_id);
        $t_menu_options = array();

        if ($options) 
        {
            foreach ($options as $option)
            {
                if ($project_id == $option['project_id'] || $option['project_id'] == -2 || 
                    ($project_id != 0 && $option['project_id'] == -1))
                {
                    $option['title'] = str_replace('project_name', $project_name, $option['title']);
                    $option['url'] = str_replace('project_name', $project_name, $option['url']);
                    $t_menu_option = array(
                        'title' => $option['title'],
                        'url' => $option['url'],
                        'access_level' => $option['access_level'],
                        'icon' => $option['icon']
                    );
                    $t_menu_options[] = $t_menu_option;
                }
            }
		}

        return $t_menu_options;
    }

    public function menuBack()
    {
        $options = plugin_config_get('main_menu_options_back');
        $project_id = helper_get_current_project();
        $project_name = project_get_name($project_id);
        $t_menu_options = array();

        if ($options) 
        {
            foreach ($options as $option)
            {
                if (isset($option['project_id']))
                {
                    foreach ($option['project_id'] as $t_proj_id)
                    {
                        if ($project_id == $t_proj_id || $t_proj_id == -2 || ($project_id != 0 && $t_proj_id == -1))
                        {
                            $t_ignore = false;

                            if (isset($option['no_project_id']))
                            {
                                foreach ($option['no_project_id'] as $t_no_proj_id) 
                                {
                                    if ($project_id == $t_no_proj_id) {
                                        $t_ignore = true;
                                    }
                                }
                            }

                            if (isset($option['no_project_name']))
                            {
                                foreach ($option['no_project_name'] as $t_no_proj_name) 
                                {
                                    if ($project_name == $t_no_proj_name) {
                                        $t_ignore = true;
                                    }
                                }
                            }

                            if ($t_ignore) {
                                continue;
                            }

                            $option['title'] = str_replace('project_name', $project_name, $option['title']);
                            $option['url'] = str_replace('project_name', $project_name, $option['url']);
                            $t_menu_option = array(
                                'title' => $option['title'],
                                'url' => $option['url'],
                                'access_level' => $option['access_level'],
                                'icon' => $option['icon']
                            );
                            $t_menu_options[] = $t_menu_option;
                        }
                    }
                }


                if (isset($option['project_name']))
                {
                    foreach ($option['project_name'] as $t_proj_name)
                    {
                        if ($project_name == $t_proj_name)
                        {
                            $t_ignore = false;

                            if (isset($option['no_project_id']))
                            {
                                foreach ($option['no_project_id'] as $t_no_proj_id) 
                                {
                                    if ($project_id == $t_no_proj_id) {
                                        $t_ignore = true;
                                    }
                                }
                            }

                            if (isset($option['no_project_name']))
                            {
                                foreach ($option['no_project_name'] as $t_no_proj_name) 
                                {
                                    if ($project_name == $t_no_proj_name) {
                                        $t_ignore = true;
                                    }
                                }
                            }

                            if ($t_ignore) {
                                continue;
                            }

                            $option['title'] = str_replace('project_name', $project_name, $option['title']);
                            $option['url'] = str_replace('project_name', $project_name, $option['url']);
                            $t_menu_option = array(
                                'title' => $option['title'],
                                'url' => $option['url'],
                                'access_level' => $option['access_level'],
                                'icon' => $option['icon']
                            );
                            $t_menu_options[] = $t_menu_option;
                        }
                    }
                }
            }
		}

        return $t_menu_options;
    }

    public function config()
    {
        return array(
            "main_menu_options_front" => array(),
            "main_menu_options_back" => array()
        );
    }
}
