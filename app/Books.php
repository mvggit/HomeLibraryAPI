<?php

namespace App;

class Books extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'books';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'author', 'ISBN', 'publication', 'cover', 'description'];

    /**
     * ValidatorValue.
     * 
     * Custom validator value.
     * 
     * @return array Validation data value.
     */
    public static function validatorValue($field)
    {
        return [
            'name' => $field['name'],
            'author' => $field['author'],
            'ISBN' => $field['ISBN'],
            'description' => $field['description']
        ];
    }
    
    /**
     * ValidatorRules.
     * 
     * Custom validator rules.
     * 
     * @return array Custom validation rules.
     */
    public static function validatorRules()
    {
        return [
            'name' =>  'required|max:150',
            'author' =>  'required|max:100',
            'ISBN' =>  'required|max:50',
            'description' =>  'required|max:2000',
        ];
    }
    
    /**
     * BookList.
     * 
     * Get List.
     * 
     * @param integer $page  current page.
     * @param string  $order Order field.
     * 
     * @return array
     */
    public static function bookList($page, $order = 'id')
    {
        $pagination = 12;
        
        if (!count(self::select('id')
                            ->skip(($page - 1) * $pagination)
                            ->take($pagination)
                            ->get()))
        {
            --$page;
        }
        
        $list = ['get' => self::select('id', 'name', 'author', 'ISBN', 'publication', 'cover', 'description')
                            ->skip(($page - 1) * $pagination)
                            ->take($pagination)
                            ->orderBy($order, 'ASC')
                            ->get()
                            ->toArray(),
                 'count' =>  ceil(self::count('name')/$pagination),
                 'page' => (int) $page
                ];
        
        return $list;
    }
    
    /**
     * Book.
     * 
     * Get book by ID.
     * 
     * @param integer $id ID item
     * 
     * @return array
     */
    public static function book($id)
    {
        $book = ['get' => self::select('id', 'name', 'author', 'ISBN', 'publication', 'cover', 'description')
                            ->where('id', '=', $id)
                            ->get()
                            ->toArray(),
                 'count' =>  1,
                 'page' => 1
                ];
        
        return $book;
    }
    
    /**
     * Search.
     * 
     * Gen list by field name & field value.
     * Returned list without paginate.
     * 
     * @param string $field Name field.
     * @param string $value Search string.
     * 
     * @return array Find list
     */
    public static function search($field, $value)
    {
        return ['get' => self::
                            where($field, 'like', '%' . $value . '%')
                          ->get()
                          ->toArray(),
                 'count' =>  1,
                 'page' => 1
                ];
    }
    
    /**
     * Remove.
     * 
     * Remove current item.
     * 
     * @param integer $id ID item.
     * 
     * @return array Weather to delete
     */
    public static function remove($id)
    {
        return self::
                  where('id', $id)->delete();
    }
    
    /**
     * EditData.
     * 
     * Save item.
     * 
     * @param arrat $data Data item.
     * 
     * @return array Weather to save
     */
    public static function editData($data)
    {
        $validate = self::validate($data);
        if (!$validate['status'])
        {
            return $validate;
        }
        
        $rows = self::updateOrCreate(['id' => isset($data['id']) ? $data['id'] : 0], $data);
     
        if ((bool) $rows && isset($data['img'], $data['cover']) && $data['img'] && $data['cover'])
        {
            $imgData = str_replace(' ','+', $data['img']);
            $imgData =  substr($imgData,strpos($imgData,",")+1);
            $imgData = base64_decode($imgData);
            file_put_contents(base_path() . '/public/images/cover/' . $data['cover'], $imgData);
        }
        
        return ['status' => $rows];
    }
}