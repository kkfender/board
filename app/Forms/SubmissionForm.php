<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;
use App\Models\Prefecture;

class SubmissionForm extends Form
{
    public function buildForm()
    {
        $prefectures = Prefecture::get();
        $prefectures = $prefectures->pluck('name','id')->toArray();

        $this
            ->add('title', 'text', [
                'label' => '題名',
                'rules' => 'required' 
            ])
            ->add('name', 'text', [
                'label' => '名前',
                'rules' => 'required'
            ])
            ->add('email', 'email', [
                'label' => 'メールアドレス',
                'rules' => 'required|email'
            ])
            ->add('prefecture_id', 'select', [
                'label' => '場所',
                'rules' => 'required',
                'choices' => $prefectures,
            ])
            ->add('body', 'textarea', [
                'label' => '本文',
                'rules' => 'required',
            ])
            ->add('operation_key', 'text', [
                'label' => '編集削除キー',
                'rules' => 'required|integer',
            ])
            ->add('submit', 'submit', ['label' => '保存']);
    }
}