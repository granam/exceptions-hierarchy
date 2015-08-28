<?php
namespace Granam\Exceptions\Tools;

class TestOfExceptionsHierarchy
{

    /** @var string */
    private $testedNamespace;

    /** @var string */
    private $rootNamespace;

    /** @var string */
    private $exceptionsSubDir;

    public function __construct($testedNamespace, $rootNamespace, $exceptionsSubDir = 'Exceptions')
    {
        $this->testedNamespace = $this->normalizeNamespace($testedNamespace);
        $rootNamespace = $this->normalizeNamespace($rootNamespace);
        $this->checkRootNamespace($rootNamespace, $this->getTestedNamespace());
        $this->rootNamespace = $rootNamespace;
        $this->exceptionsSubDir = $exceptionsSubDir;
    }

    /**
     * @param string $namespace
     *
     * @return string
     */
    protected function normalizeNamespace($namespace)
    {
        return '\\' . trim($namespace, '\\');
    }

    protected function checkRootNamespace($rootNamespace, $testedNamespace)
    {
        if (!preg_match('~^' . preg_quote($rootNamespace) . '~', $testedNamespace)) {
            throw new Exceptions\RootNamespaceHasToBeSuperior(
                "Root namespace $rootNamespace should be leading of currently tested namespace $testedNamespace"
            );
        }
    }

    /**
     * @return string
     */
    protected function getTestedNamespace()
    {
        return $this->testedNamespace;
    }

    /**
     * @return string
     */
    protected function getRootNamespace()
    {
        return $this->rootNamespace;
    }

    /**pu
     * @return string
     */
    protected function getExceptionsSubDir()
    {
        return $this->exceptionsSubDir;
    }

    protected function My_tag_interfaces_are_in_hierarchy($testedNamespace = null)
    {
        if (!$testedNamespace) {
            $testedNamespace = $this->getTestedNamespace();
        }

        $exceptionInterface = $this->assembleExceptionInterfaceClass($testedNamespace, $this->getExceptionsSubDir());
        $this->checkExceptionInterface($exceptionInterface);

        $runtimeInterface = $this->assembleRuntimeInterfaceClass($testedNamespace, $this->getExceptionsSubDir());
        $this->checkRuntimeInterface($runtimeInterface, $exceptionInterface);

        $logicInterface = $this->assembleLogicInterfaceClass($testedNamespace, $this->getExceptionsSubDir());
        $this->checkLogicInterface($logicInterface, $exceptionInterface);

        $this->checkInterfaceCollision($runtimeInterface, $logicInterface);
    }

    private function checkExceptionInterface($exceptionInterface)
    {
        if (!interface_exists($exceptionInterface)) {
            throw new Exceptions\TagInterfaceNotFound("Tag interface $exceptionInterface not found");
        }
    }

    private function checkRuntimeInterface($runtimeInterface, $exceptionInterface)
    {
        if (!interface_exists($runtimeInterface)) {
            throw new Exceptions\TagInterfaceNotFound("Runtime tag interface $runtimeInterface not found");
        }
        if (!is_a($runtimeInterface, $exceptionInterface, true)) {
            throw new Exceptions\InvalidTagInterfaceHierarchy(
                "Runtime tag interface $runtimeInterface is not a child of $exceptionInterface"
            );
        }
    }

    private function checkLogicInterface($logicInterface, $exceptionInterface)
    {
        if (!interface_exists($logicInterface)) {
            throw new Exceptions\TagInterfaceNotFound("Logic tag interface $logicInterface not found");
        }
        if (!is_a($logicInterface, $exceptionInterface, true)) {
            throw new Exceptions\InvalidTagInterfaceHierarchy(
                "Logic tag interface $logicInterface is not a child of $exceptionInterface"
            );
        }
    }

    private function checkInterfaceCollision($runtimeInterface, $logicInterface)
    {
        if (is_a($runtimeInterface, $logicInterface, true)) {
            throw new Exceptions\InvalidTagInterfaceHierarchy(
                "Runtime tag interface $runtimeInterface can not be a logic tag"
            );
        }
        if (is_a($logicInterface, $runtimeInterface, true)) {
            throw new Exceptions\InvalidTagInterfaceHierarchy(
                "Logic tag interface $logicInterface can not be a runtime tag"
            );
        }
    }

    public function My_exceptions_are_in_family_tree()
    {
        $parentNamespace = $this->getTestedNamespace();
        do {
            $this->My_tag_interfaces_are_in_hierarchy($parentNamespace);
            $directory = $this->getNamespaceDirectory($parentNamespace);
            foreach ($this->getCustomExceptionsFrom($directory) as $customException) {
                $this->My_exceptions_are_properly_tagged($customException);
            }
            $alreadyInRoot = $parentNamespace === $this->getRootNamespace();
            $parentNamespace = $this->parseParentNamespace($parentNamespace);
        } while (!$alreadyInRoot && $parentNamespace);
    }

    protected function getNamespaceDirectory($namespace)
    {
        $rootNamespace = preg_replace('~^(\\\?\w+).*~', '$1', $namespace);
        $reflection = new \ReflectionClass($this);
        $filename = $reflection->getFileName();
        $dir = dirname($filename);
        $baseDir = preg_replace('~(' . preg_quote($rootNamespace) . ').*~', '', str_replace(DIRECTORY_SEPARATOR, '\\', $dir));
        $namespaceDir = str_replace('\\', DIRECTORY_SEPARATOR, $baseDir . $namespace);

        return $namespaceDir;
    }

    protected function getCustomExceptionsFrom($directory)
    {
        $customExceptions = array();
        foreach (scandir($directory) as $file) {
            $filePath = $directory . DIRECTORY_SEPARATOR . $file;
            if (is_file($filePath)) {
                $content = file_get_contents($filePath);
                if (preg_match('~(namespace\s+(?<namespace>(\w+(\\\)?)+)).+(class|interface)\s+(?<className>\w+)~s', $content, $matches)) {
                    if (!in_array($matches['className'], array('Exception', 'Runtime', 'Logic'))) {
                        $customExceptions[] = $matches['namespace'] . '\\' . $matches['className'];
                    }
                }
            }
        }

        return $customExceptions;
    }

    protected function My_exceptions_are_properly_tagged($exceptionClass)
    {
        $namespace = $this->parseNamespaceFromClass($exceptionClass);
        $isBaseTagged = is_a($exceptionClass, $this->assembleExceptionInterfaceClass($namespace), true);
        if (!$isBaseTagged) {
            throw new Exceptions\ExceptionIsNotTaggedProperly(
                (class_exists($exceptionClass) ? 'Class' : 'Tag interface')
                . " $exceptionClass has to be tagged by Exception interface"
            );
        }
        $isRuntime = is_a($exceptionClass, $this->assembleRuntimeInterfaceClass($namespace), true);
        $isLogic = is_a($exceptionClass, $this->assembleLogicInterfaceClass($namespace), true);
        if ($isRuntime && $isLogic) {
            throw new Exceptions\ExceptionIsNotTaggedProperly(
                "Exception " . (class_exists($exceptionClass) ? 'class' : 'interface')
                . " $exceptionClass can not be tagged by Runtime interface and Logic interface at the same time"
            );
        }
        if (!$isRuntime && !$isLogic) {
            throw new Exceptions\ExceptionIsNotTaggedProperly(
                "Exception " . (class_exists($exceptionClass) ? 'class' : 'interface')
                . " $exceptionClass is not tagged by Runtime interface or even Logic interface"
            );
        }
        if (class_exists($exceptionClass)) {
            $this->My_exception_is_child_of_proper_base_exception($exceptionClass, $isRuntime);
        }
    }

    /**
     * @param string $exceptionClass
     * @param bool $isRuntime
     */
    protected function My_exception_is_child_of_proper_base_exception($exceptionClass, $isRuntime)
    {
        if (!is_a($exceptionClass, '\Exception', true)) {
            throw new Exceptions\InvalidExceptionHierarchy("$exceptionClass should be child of \\Exception");
        }

        if ($isRuntime) {
            if (!is_a($exceptionClass, '\RuntimeException', true)) {
                throw new Exceptions\InvalidExceptionHierarchy("$exceptionClass should be child of \\RuntimeException");
            }
        } else {
            if (!is_a($exceptionClass, '\LogicException', true)) {
                throw new Exceptions\InvalidExceptionHierarchy("$exceptionClass should be child of \\LogicException");
            }
        }
    }

    protected function parseNamespaceFromClass($className)
    {
        return preg_replace('~(\\\|\w+)$~', '', $className);
    }

    protected function assembleExceptionInterfaceClass($namespace, $subDir = false)
    {
        return $this->assembleClassName($namespace, $subDir, 'Exception');
    }

    protected function assembleRuntimeInterfaceClass($namespace, $subDir = false)
    {
        return $this->assembleClassName($namespace, $subDir, 'Runtime');
    }

    protected function assembleLogicInterfaceClass($namespace, $subDir = false)
    {
        return $this->assembleClassName($namespace, $subDir, 'Logic');
    }

    private function assembleClassName($namespace, $subDir, $className)
    {
        return $this->normalizeNamespace($namespace) . ($subDir ? ('\\' . $subDir) : '') . '\\' . $className;
    }

    protected function parseParentNamespace($toNamespace)
    {
        return preg_replace('~[\\\]\w+$~', '', $toNamespace);
    }

}
