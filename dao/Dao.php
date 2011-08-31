<?php
interface Dao{
	public static function deleteAll($entities);
	public static function save($entity);
	public static function update($entity);
	public static function persist($entity);
	public static function delete($entity);
	public static function findByQuery($query);
	public static function merge($entity);
	public static function findAll();
   public static function findById($id);
}
?>