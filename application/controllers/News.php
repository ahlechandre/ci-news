<?php

use Eloquent\NewsModel;

class News extends CI_Controller 
{

    /**
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->setHelpers();
        $this->setLibraries();
    }

    /**
     *
     * @return void
     */
    public function index()
    {
        $newsItems = NewsModel::all();
        $this->july::view()->layout('default', [
            'title' => 'News',            
        ])->page('news', [
            'newsItems' => $newsItems,
        ])->render();
    }

    /**
     *
     * @return void
     */
    public function create($validationErrors = null) {
        $this->july::view()->layout('default', [
            'title' => 'Create a news',
        ])->page('newsItemAdd', [
            'validationErrors' => $validationErrors,
        ])->render();
    }

    /**
     *
     * @return void
     */
    public function store() {
        $request = $this->input->post();
        $validationErrors = [];
        $validationAliases = [
            'news-title' => 'Title',
            'news-content' => 'Content text',
        ];

        if (!isset($request['news-title']) || !$request['news-title']) {
            $validationErrors[] = [
                'field' => $validationAliases['news-title'],
                'message' => 'News title are missing.',
            ];
        }

        if (!isset($request['news-content']) || !$request['news-content']) {
            $validationErrors[] = [
                'field' => $validationAliases['news-content'],
                'message' => 'News content text are missing.',
            ];
        }

        // Display validation errors if they exists.
        if (sizeof($validationErrors) > 0) {
            $this->create($validationErrors);
            return;
        }

        $newsModel = new NewsModel;
        $newsModel->title = $request['news-title'];
        $newsModel->text = $request['news-content'];
        $newsModel->slug = $this->july::slugify($request['news-title']);
        $newsModel->save();
        // Redirects client to list news page.
        header('Location: ' . base_url() . 'news/');
    }

    /**
     *
     * @return void
     */
    public function show($slug) 
    {
        $newsItem = NewsModel::where('slug', $slug)->first();

        if (!$newsItem) {
            $this->output->set_status_header('404');
            show_404();
            return;
        }

        $this->july::view()->layout('default', [
            'title' => $slug,
        ])->page('newsItem', [
            'newsItem' => $newsItem,
        ])->render();
    }

    /**
     *
     * @return void
     */
    public function edit($slug)
    {
        $newsItem = NewsModel::where('slug', $slug)->first();

        if (!$newsItem) {
            $this->output->set_status_header('404');
            show_404();
            return;
        }

        $this->july::view()->layout('default', [
            'title' => "{$slug} - Edit",
        ])->page('newsItemEdit', [
            'newsItem' => $newsItem,            
        ])->render();

    }

    /**
     *
     * @return void
     */
    public function update($slug)
    {
        // Verifies if client puts it stream into a named field "json".
        if (!isset($this->input->input_stream()['json'])) exit;

        $requestBodyJson = $this->input->input_stream()['json'];

        // Checks if the field "json" is empty.
        if (!$requestBodyJson) exit;

        $newsModel = NewsModel::where('slug', $slug)->first();

        // Check if model register exists on database.
        if (!$newsModel) exit;

        header('Content-Type: application/json');
        $headerLocation = false;
        $decodedRequestBody = json_decode($requestBodyJson, true);
        $fillableAliases = [
            'title' => 'news-title', 
            'text' => 'news-content',
        ];
        $updateData = [];

        foreach ($fillableAliases as $fillable => $alias) {
            if (isset($decodedRequestBody[$alias]) && $decodedRequestBody[$alias]) {
                $updateData[$fillable] = $decodedRequestBody[$alias];
            }
        }

        // Add new slug.
        if (isset($updateData['title']) && $updateData['title']) {
            $newsModel->slug = $this->july::slugify($updateData['title']);

            if ($newsModel->slug !== $slug) {
                $headerLocation = base_url() . 'news/' . $newsModel->slug;                
            }
        }

        $updated = $newsModel->update($updateData);
        echo json_encode([
            'success' => $updated,
            'location' => $headerLocation,
        ]);
    }

    /**
     *
     * @return void
     */
    public function destroy($slug) 
    {
        $news = NewsModel::where('slug', $slug)->first();

        // Check if model register exists on database.
        if (!$news) exit;

        header('Content-Type: application/json');
        $deleted = $news->delete();
        echo json_encode([
            'success' => $deleted,
            'location' => base_url() . 'news/',
        ]);
    }

    /**
     * Initializes libraries in $this object.
     * 
     * @return void
     */
    private function setHelpers() 
    {
        $this->load->helper('url');
    }

    /**
     * Initializes libraries in $this object.
     * 
     * @return void
     */
     private function setLibraries() 
     {
        $this->load->library('july');
     }
}