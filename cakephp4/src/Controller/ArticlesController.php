<?php

namespace App\Controller;

class ArticlesController extends AppController
{
  public function initialize(): void
  {
    parent::initialize();

    $this->loadComponent('Paginator');
    $this->loadComponent('Flash'); // Include the FlashComponent
  }

  public function index()
  {
    $articles = $this->Paginator->paginate($this->Articles->find());
    $this->set(compact('articles'));
  }

  public function view($slug)
  {
    $article = $this->Articles->findBySlug($slug)->firstOrFail();
    $this->set(compact('article'));
  }

  public function add()
  {
    $article = $this->Articles->newEmptyEntity();
    if ($this->request->is('post')) {
      $article = $this->Articles->patchEntity($article, $this->request->getData());

      $article->user_id = 1; // hardcoded till the autentication service

      if ($this->Articles->save($article)) {
        $this->Flash->success(__('Your article has been saved.'));
        return $this->redirect(['action' => 'index']);
      }
      $this->Flash->error(__('Unable to add your article.'));
    }
    $this->set('article', $article);
  }
}
