<?php
namespace Home\Model;

use Think\Model;

class BaseModel extends Model
{
    public function getOneById($id)
    {
        return $this->find($id);
    }

    /**
     * 返回一条数据
     * @param array $where 查询条件
     * @return bool|array 返回数据
     */
    public function getOne($where, $field = '', $order = '')
    {
        if ($field) {
            $this->field($field);
        }
        if ($where) {
            $this->where($where);
        }
        if ($order) {
            $this->order($order);
        }
        $result = $this->find();
        if (empty($result)) {
            return false;
        } else {
            return $result;
        }
    }

    /**
     * 返回多条数据
     * @param array $where 查询条件
     * @param string|array $field 查询字段
     * @param string|array $order 排序
     * @param string $limit 查询条数
     * @return bool|mixed 查询结果
     */
    public function getList($where = array(), $field = '', $order = '', $limit = '')
    {
        if ($field) {
            $this->field($field);
        }
        if ($where) {
            $this->where($where);
        }
        if ($order) {
            $this->order($order);
        }
        if ($limit) {
            $this->limit($limit);
        }
        $result = $this->select();
        if (empty($result)) {
            return false;
        } else {
            return $result;
        }
    }

    /**
     * 获取一条记录的某个字段值
     * @param string $field 字段名
     * @param string $field 字段名
     * @param string $spea 字段数据间隔符号 NULL返回数组
     * @return mixed
     */
    public function getColumn($where = [], $field = 'id', $sepa = null)
    {
        return $this->where($where)->getField($field, $sepa);
    }
}
