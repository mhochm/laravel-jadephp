<?php

namespace mhochm\LaravelJadePHP;

use Illuminate\Filesystem\Filesystem;
use Illuminate\View\Compilers\Compiler;
use Illuminate\View\Compilers\CompilerInterface;
use Jade\Jade;

class JadeCompiler extends Compiler implements CompilerInterface
{
    /**
     * @var Jade
     */
    private $jade;
    /**
     * Create a new JadeCompiler instance.
     *
     * @param \Illuminate\Filesystem\Filesystem $files
     * @param string $cachePath
     */
    public function __construct(Filesystem $files, $cachePath)
    {
        parent::__construct($files, $cachePath);
        $this->jade = $jade = new Jade([
            'prettyprint' => true,
            'extension' => '.jade'
        ]);
    }
    /**
     * Compile the view at the given path.
     *
     * @param  string $path
     * @return void
     */
    public function compile($path)
    {
        $contents = $this->compileString($path);
        if (!is_null($this->cachePath)) {
            $this->files->put($this->getCompiledPath($path), $contents);
        }
    }
    /**
     * Compile the given Jade template contents.
     *
     * @param  string $value
     * @return string
     */
    public function compileString($value)
    {
        return $this->jade->compile($value);
    }
}