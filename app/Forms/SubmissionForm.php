<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;
use App\Models\Prefecture;
use App\Models\Board;

class SubmissionForm extends Form
{
    public function buildForm()
    {
        $prefectures = Prefecture::get();
        $prefectures = $prefectures->pluck('name','id')->toArray();

        //sinnkisaskuseito分けるほうがいいかもしれない
        $board = Board::find($this->data['id']) ? Board::find($this->data['id']) : 0;

        $this
            ->add('title', 'text', [
                'label' => '題名',
                'rules' => 'required',
                'default_value' => $board->title,
            ])
            ->add('name', 'text', [
                'label' => '名前',
                'rules' => 'required',
                'default_value' => $board->name,
            ])
            ->add('email', 'email', [
                'label' => 'メールアドレス',
                'rules' => 'required|email',
                'default_value' => $board->email,
            ])
            ->add('prefecture_id', 'select', [
                'label' => '場所',
                'rules' => 'required',
                'choices' => $prefectures,
                'default_value' => $board->prefecture_id,
            ])
            ->add('body', 'textarea', [
                'label' => '本文',
                'rules' => 'required',
                'default_value' => $board->body,
            ])
            ->add('operation_key', 'text', [
                'label' => '編集削除キー',
                'rules' => 'required|integer',
                'default_value' => $board->operation_key,
            ])
            ->add('submit', 'submit', ['label' => '保存']);
    }
}