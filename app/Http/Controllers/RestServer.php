<?php

namespace App\Http\Controllers;
use Input;
use App\Books;

class RestServer extends Controller
{
    /**
     * Book.
     * 
     * Gen book list.
     * 
     * @return array Status & data value.
     */
    public function book($id = 0)
    {
        return isset($id) && $id ? $this->getBook($id)
                                 : $this->getBookList(Input::get('page'), Input::get('order'));
    }

    /**
     * Edit.
     * 
     * Processing add & edit.
     * 
     * @return array Status & data value.
     */
    public function edit()
    {
        $input = Input::all();
        return Books::editData($input);
    }
    
    
    /**
     * Search.
     * 
     * Call to search function in model &
     * return page lists book.
     * 
     * @return array Status & data value.
     */
    public function search()
    {
        $field = Input::get('field');
        $value = Input::get('value');
        $result = ['data' => Books::search($field, $value),
                   'status' => true
                    ];
        if (empty($result['data']))
        {
            $result = ['status' => false, 
                        'msg' => 'Книга не найдена'
                        ];
        }
        
        return $result;
    }
    
    /**
     * Delete.
     * 
     * Call to delete function in model &
     * return list from paginated page.
     * 
     * @return array Status & data value.
     */
    public function delete()
    {
        Books::remove(Input::get('id'));
        return $this->getBookList(Input::get('page'));
    }

    /**
     * getBook.
     * 
     * Gen & return one book with custom id.
     * 
     * @param integer $id ID library item.
     * 
     * @return array Status & data value.
     */
    private function getBook($id)
    {
        $data = Books::book($id);
        
        if (empty($data['get']))
        {
            $result = ['status' => false, 'msg' => 'Книга не найдена'];
        }
        else
        {
            $result = ['status' => true, 
                       'data' => $data
                      ];
        }
        
        return $result;
    }
    
    /**
     * getBookList.
     * 
     * Gen & return list from paginated 
     * or with custom item page.
     * 
     * @param integer $page  ID paginated page.
     * @param integer $order Order field.
     * 
     * @return array Status & data value.
     */
    private function getBookList($page = 1, $order = 'id')
    {
        $data = Books::bookList($page, $order);
        
        if (empty($data['get']))
        {
            $result = ['status' => false, 'msg' => 'Книга не найдена'];
        }
        else
        {
            $result = ['status' => true, 
                       'data' => $data
                      ];
        }
        
        return $result;
    }
}