import os
import sys
sys.path.insert(0, os.path.abspath('..'))

project = 'Lodel HelloWorld Bundle'
author = 'OpenEdition'
release = '0.1.0'

extensions = [
    'sphinx.ext.autodoc',
    'sphinx.ext.napoleon',
    'sphinx.ext.viewcode',
    'myst_parser',
]

source_suffix = {
    '.md': 'markdown',
}

html_theme = 'furo'
