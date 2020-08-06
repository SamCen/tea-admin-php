<?php
/**
 * Author Cjc
 * DateTime 2020/8/4 5:57 下午
 * Description:
 */
if (! function_exists('getDependentObject')) {
    /**
     * 获取依赖对象
     *
     * @param object $object 当前对象
     * @param string $className 依赖对象类名(包含完整命名空间)
     * @param string $propertyName 依赖对象挂载在当前对象的哪个属性名称上
     * @param array $parameters 实例化对象时传给构造方法的参数列表
     * @return object|mixed
     */
    function getDependentObject(object $object, string $className, string $propertyName = null, array $parameters = []):object
    {
        // 没有设置有效的挂载属性名称时，默认使用被依赖对象的小驼峰名称，并且不包含其命名空间
        if (! $propertyName) {

            $propertyName = lcfirst(class_basename($className));
        }

        if (! property_exists($object, $propertyName) || is_null($object->$propertyName)) {

            $object->$propertyName = app($className, $parameters);
        }

        return $object->$propertyName;
    }
}
