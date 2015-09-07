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

    /** @var string|bool */
    private $externalRootNamespace;

    /**
     * @param string $testedNamespace
     * @param string $rootNamespace
     * @param string $exceptionsSubDir
     * @param string|bool $externalParentRootNamespace = false
     */
    public function __construct(
        $testedNamespace,
        $rootNamespace,
        $exceptionsSubDir = 'Exceptions',
        $externalParentRootNamespace = false
    )
    {
        $testedNamespace = $this->normalizeNamespace($testedNamespace);
        $rootNamespace = $this->normalizeNamespace($rootNamespace);
        $this->checkRootNamespace($rootNamespace, $testedNamespace);
        $this->checkExternalRootNamespace($externalParentRootNamespace, $rootNamespace);

        $this->testedNamespace = $testedNamespace;
        $this->rootNamespace = $rootNamespace;
        $this->exceptionsSubDir = $exceptionsSubDir;
        $this->externalRootNamespace = $externalParentRootNamespace;
    }

    /**
     * @param string $namespace
     *
     * @return string
     */
    protected function normalizeNamespace($namespace)
    {
        if (!is_string($namespace)) {
            throw new Exceptions\MissingNamespace(
                'Namespace can be empty string for root, but given ' . var_export($namespace, true)
            );
        }

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

    protected function checkExternalRootNamespace($externalRootNamespace, $rootNamespace)
    {
        if (!$externalRootNamespace) {
            return;
        }
        if (strpos($rootNamespace, $externalRootNamespace)) {
            throw new Exceptions\RootNamespaceHasToBeSuperior(
                "External root namespace $externalRootNamespace should not be subordinate to local root namespace $rootNamespace"
            );
        }
        $this->My_tag_interfaces_are_in_hierarchy($externalRootNamespace, []);
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

    /**
     * @return string
     */
    protected function getExceptionsSubDir()
    {
        return $this->exceptionsSubDir;
    }

    /**
     * @return bool|string
     */
    protected function getExternalRootNamespace()
    {
        return $this->externalRootNamespace;
    }

    protected function My_tag_interfaces_are_in_hierarchy($testedNamespace, array $childNamespaces)
    {
        $exceptionInterface = $this->assembleExceptionInterfaceClass($testedNamespace, $this->getExceptionsSubDir());
        $externalRootExceptionInterface = $this->getExternalRootExceptionInterfaceClass();
        $this->checkExceptionInterface($exceptionInterface, $externalRootExceptionInterface);

        $runtimeInterface = $this->assembleRuntimeInterfaceClass($testedNamespace, $this->getExceptionsSubDir());
        $externalRootRuntimeInterface = $this->getExternalRootRuntimeInterfaceClass();
        $this->checkRuntimeInterface($runtimeInterface, $exceptionInterface, $externalRootRuntimeInterface);

        $logicInterface = $this->assembleLogicInterfaceClass($testedNamespace, $this->getExceptionsSubDir());
        $externalRootLogicInterface = $this->getExternalRootLogicInterfaceClass();
        $this->checkLogicInterface($logicInterface, $exceptionInterface, $externalRootLogicInterface);

        $this->checkInterfaceCollision($runtimeInterface, $logicInterface);

        $this->checkChildInterfaces($childNamespaces, $exceptionInterface, $runtimeInterface, $logicInterface);
    }

    /**
     * @return bool|string
     */
    private function getExternalRootExceptionInterfaceClass()
    {
        $externalRootNamespace = $this->getExternalRootNamespace();
        if (!$externalRootNamespace) {
            return false;
        }

        return $this->assembleExceptionInterfaceClass($externalRootNamespace, $this->getExceptionsSubDir());
    }

    /**
     * @return bool|string
     */
    private function getExternalRootRuntimeInterfaceClass()
    {
        $externalRootNamespace = $this->getExternalRootNamespace();
        if (!$externalRootNamespace) {
            return false;
        }

        return $this->assembleRuntimeInterfaceClass($externalRootNamespace, $this->getExceptionsSubDir());
    }

    /**
     * @return bool|string
     */
    private function getExternalRootLogicInterfaceClass()
    {
        $externalRootNamespace = $this->getExternalRootNamespace();
        if (!$externalRootNamespace) {
            return false;
        }

        return $this->assembleLogicInterfaceClass($externalRootNamespace, $this->getExceptionsSubDir());
    }

    /**
     * @param $exceptionInterface
     * @param string|false $externalRootExceptionInterface
     */
    private function checkExceptionInterface($exceptionInterface, $externalRootExceptionInterface)
    {
        if (!interface_exists($exceptionInterface)) {
            throw new Exceptions\TagInterfaceNotFound("Tag interface $exceptionInterface not found");
        }
        if ($externalRootExceptionInterface && !is_a($exceptionInterface, $externalRootExceptionInterface, true)) {
            throw new Exceptions\InvalidTagInterfaceHierarchy(
                "Tag interface $exceptionInterface should extends external parent tag interface $externalRootExceptionInterface"
            );
        }
    }

    private function checkRuntimeInterface($runtimeInterface, $exceptionInterface, $externalRootRuntimeInterface)
    {
        if (!interface_exists($runtimeInterface)) {
            throw new Exceptions\TagInterfaceNotFound("Runtime tag interface $runtimeInterface not found");
        }
        if (!is_a($runtimeInterface, $exceptionInterface, true)) {
            throw new Exceptions\InvalidTagInterfaceHierarchy(
                "Runtime tag interface $runtimeInterface is not a child of $exceptionInterface"
            );
        }
        if ($externalRootRuntimeInterface && !is_a($runtimeInterface, $externalRootRuntimeInterface, true)) {
            throw new Exceptions\InvalidTagInterfaceHierarchy(
                "Tag interface $runtimeInterface should extends external parent tag interface $externalRootRuntimeInterface"
            );
        }
    }

    private function checkLogicInterface($logicInterface, $exceptionInterface, $externalRootLogicInterface)
    {
        if (!interface_exists($logicInterface)) {
            throw new Exceptions\TagInterfaceNotFound("Logic tag interface $logicInterface not found");
        }
        if (!is_a($logicInterface, $exceptionInterface, true)) {
            throw new Exceptions\InvalidTagInterfaceHierarchy(
                "Logic tag interface $logicInterface is not a child of $exceptionInterface"
            );
        }
        if ($externalRootLogicInterface && !is_a($logicInterface, $externalRootLogicInterface, true)) {
            throw new Exceptions\InvalidTagInterfaceHierarchy(
                "Tag interface $logicInterface should extends external parent tag interface $externalRootLogicInterface"
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

    private function checkChildInterfaces(array $childNamespaces, $exceptionInterface, $runtimeInterface, $logicInterface)
    {
        foreach ($childNamespaces as $childNamespace) {
            $childExceptionInterface = $this->assembleExceptionInterfaceClass($childNamespace, $this->getExceptionsSubDir());
            if (!is_a($childExceptionInterface, $exceptionInterface, true)) {
                throw new Exceptions\InvalidExceptionHierarchy(
                    "Tag $childExceptionInterface should be child of $exceptionInterface"
                );
            }

            $childRuntimeInterface = $this->assembleRuntimeInterfaceClass($childNamespace, $this->getExceptionsSubDir());
            if (!is_a($childRuntimeInterface, $runtimeInterface, true)) {
                throw new Exceptions\InvalidExceptionHierarchy(
                    "Tag $childRuntimeInterface should be child of $runtimeInterface"
                );
            }

            $childLogicInterface = $this->assembleLogicInterfaceClass($childNamespace, $this->getExceptionsSubDir());
            if (!is_a($childLogicInterface, $logicInterface, true)) {
                throw new Exceptions\InvalidExceptionHierarchy(
                    "Tag $childLogicInterface should be child of $logicInterface"
                );
            }
        }
    }


    public function My_exceptions_are_in_family_tree()
    {
        $childNamespaces = [];
        $testedNamespace = $this->getTestedNamespace();
        do {
            $this->My_tag_interfaces_are_in_hierarchy($testedNamespace, $childNamespaces);
            $directory = $this->getNamespaceDirectory($testedNamespace);
            foreach ($this->getCustomExceptionsFrom($directory) as $customException) {
                $this->My_exceptions_are_properly_tagged($customException);
            }
            $alreadyInRoot = $testedNamespace === $this->getRootNamespace();
            $childNamespaces[] = $testedNamespace;
            $testedNamespace = $this->parseParentNamespace($testedNamespace);
        } while (!$alreadyInRoot && $testedNamespace);
    }

    protected function getNamespaceDirectory($namespace)
    {
        $exceptionTag = $this->assembleExceptionInterfaceClass($namespace, $this->getExceptionsSubDir());
        $exceptionTagReflection = new \ReflectionClass($exceptionTag);
        $filename = $exceptionTagReflection->getFileName();
        $namespaceDir = dirname($filename);

        return $namespaceDir;
    }

    protected function getCustomExceptionsFrom($directory)
    {
        $customExceptions = [];
        foreach (scandir($directory) as $file) {
            $filePath = $directory . DIRECTORY_SEPARATOR . $file;
            if (is_file($filePath)) {
                $content = file_get_contents($filePath);
                if (preg_match('~(namespace\s+(?<namespace>(\w+(\\\)?)+)).+(class|interface)\s+(?<className>\w+)~s', $content, $matches)) {
                    if (!in_array($matches['className'], ['Exception', 'Runtime', 'Logic'])) {
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
