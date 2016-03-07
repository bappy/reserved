<?php

class SettingsController extends AppController {

    var $name = 'Settings';    

    function admin_index() {
        $this->layout = "admin";
        if (!empty($this->request->data)) {
            foreach ($this->request->data['Settings'] as $key => $value) {
                $this->Setting->name = "";
                $data['Setting']['name'] = $key;
                $data['Setting']['value'] = $value;
                
                $this->Setting->updateAll(
                        array('Setting.value' => $value),  //condition
                        array('Setting.name' => $key) //fields to update                        
                );
            }
        }

        $settings = $this->Setting->find("all");        
        $this->set(compact('settings'));
    }
}
?>