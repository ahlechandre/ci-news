<?php

class News_model extends CI_Model {

    /**
     *
     * @var string
     */
    protected $queryString = '';

    /**
     *
     * @var string
     */
    protected $queryStringBindings = [];

    /**
     *
     * @return void
     */
    public function __construct() 
    {
        parent::__construct();
        $this->load->database('default');
    }

    /**
     *
     * @return bool
     */
    public function update($column, $value, $data) 
    {
        $this->db->where($column, $value);
        return $this->db->update('news', $data);
    }

    /**
     *
     *
     */
    public function where($column, $value) 
    {
        $this->queryString = $this->queryString ? 
            "{$this->queryString} AND {$column} = ?" : "{$column} = ?";
        $this->queryStringBindings[] = $value;
        return $this;
    }

    /**
     *
     *
     */
    public function get()
    {
        if (!$this->queryString) return null;
        
        return $this->db
        ->query("SELECT * FROM news WHERE {$this->queryString}", $this->queryStringBindings)
        ->row();
    }

    /**
     *
     *
     */
    public function all() 
    {
        $queryString = 'SELECT * FROM news';
        $query = $this->db->query($queryString);
        $news = [];

        foreach($query->result() as $row) {
            $news[$row->id] = [
                'title' => $row->title,
                'slug' => $row->slug,
                'text' => $row->text,
            ];
        }
        return $news;
    }
}
