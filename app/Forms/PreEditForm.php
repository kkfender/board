<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;
use App\Models\Prefecture;

class PreEditForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('id', 'text', [
                'label' => '投稿No',
                'rules' => 'required|integer' 
            ])
            ->add('operation_key', 'text', [
                'label' => '編集削除キー',
                'rules' => 'required|integer'
            ])
            ->add('submit', 'submit', ['label' => '保存']);
    }
}