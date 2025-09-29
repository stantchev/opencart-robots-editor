<?php
/**
 * Robots.txt Editor & Cache Control Module for OpenCart 2.3.0.2
 *
 * Copyright (C) 2025  Станчев
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */
 
class ControllerExtensionModuleRobotsEditor extends Controller {
    private $error = array();

    public function index() {
        $this->load->language('extension/module/robots_editor');

        $this->document->setTitle($this->language->get('text_title'));

        $this->load->model('setting/setting');
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            if (isset($this->request->post['robots'])) {
                // Път към публичния robots.txt
                $file = $_SERVER['DOCUMENT_ROOT'] . '/robots.txt';

                // Опит за временни права
                if (file_exists($file)) {
                    @chmod($file, 0666);
                }

                $handles = fopen($file, 'w+'); 

                if ($handles) {
                    $robots = str_replace("&amp;", "&", $this->request->post['robots']);
                    $bytes  = fwrite($handles, $robots);
                    fclose($handles);

                    if ($bytes !== false) {
                        @chmod($file, 0644);
                    }
                }

                // DEBUG ИЗХОД – ще покаже пътища и съдържание
                echo "<pre>";
                echo "DIR_SYSTEM: " . DIR_SYSTEM . "\n";
                echo "__DIR__: " . __DIR__ . "\n";
                echo "DOCUMENT_ROOT: " . $_SERVER['DOCUMENT_ROOT'] . "\n\n";

                echo "PATH: " . $file . "\n";
                echo "WROTE BYTES: " . (isset($bytes) ? $bytes : 'FAILED') . "\n\n";

                echo "CONTENT NOW IN FILE:\n";
                if (file_exists($file)) {
                    echo file_get_contents($file);
                } else {
                    echo "robots.txt NOT FOUND at this path!";
                }
                echo "</pre>";
                exit;
            }
        }
        
        $data['heading_title'] = $this->language->get('heading_title');
        $data['text_edit'] = $this->language->get('text_edit');
        $data['entry_create'] = $this->language->get('entry_create');
        $data['entry_clean'] = $this->language->get('entry_clean');
        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_module'),
            'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_title'),
            'href' => $this->url->link('extension/module/robots_editor', 'token=' . $this->session->data['token'], true)
        );
        
        $data['action'] = $this->url->link('extension/module/robots_editor', 'token=' . $this->session->data['token'], true);
        $data['cancel'] = $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true);

        $data['text'] = '';

        // Четем публичния robots.txt
        $file = $_SERVER['DOCUMENT_ROOT'] . '/robots.txt';

        if (file_exists($file)) {
            $data['text'] = file_get_contents($file, FILE_USE_INCLUDE_PATH, null);
        } 

        $data['token'] = $this->session->data['token'];

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');
        
        $this->response->setOutput($this->load->view('extension/module/robots_editor', $data));
    }

    protected function validate() {
        // За тест няма ограничения
        return true;
    }
}