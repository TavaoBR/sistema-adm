<?php 

namespace Src\Database\Model;

use Src\Database\Filters;
use Src\Database\Pagination;
use Src\Database\Connection;
use PDOException;
use PDO;

abstract class Model {

  private string $fields = '*';
  private ?Filters $filters = null;
  private string $pagination = '';
  protected string $table;

  public function setFields($fields)
  {
    $this->fields = $fields;
  }

  public function setFilters(Filters $filters)
  {
    $this->filters = $filters;
  }

  public function setPagination(Pagination $pagination)
  {
    $pagination->setTotalItems($this->count());
    $this->pagination = $pagination->dump();
  }

  public function create(array $data)
  {
    try {
      $sql = "insert into {$this->table} (";
      $sql .= implode(',', array_keys($data)) . ") values(";
      $sql .= ':' . implode(',:', array_keys($data)) . ")";

      $connect = Connection::connect();

      $prepare = $connect->prepare($sql);

      $prepare->execute($data);
     
      return [$prepare->rowCount(), $connect->lastInsertId()];

    } catch (PDOException $e) {
      var_dump($e->getMessage());
    }
  }


  // $user->update('id', 22,['firstName' => 'alexa'])

  // update users set firstName = 'Mario', lastName = 'Santos' where id = 22

  public function update(string $field, string|int $fieldValue, array $data)
  {
    try {
      $sql = "update {$this->table} set ";
      foreach ($data as $key => $value) {
        $sql .= "{$key} = :{$key},";
      }

      $sql = rtrim($sql, ',');

      $sql .= " where {$field} = :{$field}";

      $connection = Connection::connect();

      $data[$field] = $fieldValue;

      $prepare = $connection->prepare($sql);

      $prepare->execute($data);
      
      return $prepare->rowCount();

    } catch (PDOException $e) {
      var_dump($e->getMessage());
    }
  }

  public function fetchAll()
  {
    try {
      $sql = "select {$this->fields} from {$this->table} {$this->filters?->dump()} {$this->pagination}";

      $connection = Connection::connect();

      $prepare = $connection->prepare($sql);
      $prepare->execute($this->filters ? $this->filters->getBind() : []);

      return [$prepare->rowCount(), $prepare->fetchAll(PDO::FETCH_CLASS)] ;
    } catch (PDOException $e) {
      var_dump($e->getMessage());
    }
  }

  public function findBy(string $field = '', string $value = '', bool $singleResult = true)
  {
    try {
      $sql = (empty($this->filters)) ?
        "select {$this->fields} from {$this->table} where {$field} = :{$field}" :
        "select {$this->fields} from {$this->table} {$this->filters?->dump()}";
  
      $connection = Connection::connect();
  
      $prepare = $connection->prepare($sql);
  
      $prepare->execute($this->filters ? $this->filters->getBind() : [$field => $value]);
  
      if ($singleResult) {
        return [$prepare->rowCount(), $prepare->fetchObject()];
      } else {
        return [$prepare->rowCount(), $prepare->fetchAll(PDO::FETCH_OBJ)];
      }
    } catch (PDOException $e) {
      var_dump($e->getMessage());
    }
  }

  public function first($field = 'id', $order = 'asc')
  {
    try {
      $sql = "select {$this->fields} from {$this->table} order by {$field} {$order} limit 1";

      $connection = Connection::connect();

      $query = $connection->query($sql);

      return $query->fetchObject();
    } catch (PDOException $e) {
      var_dump($e->getMessage());
    }
  }

  public function delete(string $field = '', string|int $value = '')
  {
    try {
      $sql = (!empty($this->filters)) ?
        "delete from {$this->table} {$this->filters}" :
        "delete from {$this->table} where {$field} = :{$field}";

      $connection = Connection::connect();

      $prepare = $connection->prepare($sql);

      return $prepare->execute(empty($this->filters) ? [$field => $value] : $this->filters->getBind());
    } catch (PDOException $e) {
      var_dump($e->getMessage());
    }
  }

  public function count()
  {
    try {
      $sql = "select {$this->fields} from {$this->table} {$this->filters->dump()}";

      $connection = Connection::connect();

      $prepare = $connection->prepare($sql);
      $prepare->execute($this->filters ? $this->filters->getBind() : []);

      return $prepare->rowCount();
    } catch (PDOException $e) {
      var_dump($e->getMessage());
    }
  }

}