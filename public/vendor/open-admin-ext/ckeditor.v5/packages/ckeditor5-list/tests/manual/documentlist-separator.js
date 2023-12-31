/**
 * @license Copyright (c) 2003-2023, CKSource Holding sp. z o.o. All rights reserved.
 * For licensing, see LICENSE.md or https://ckeditor.com/legal/ckeditor-oss-license
 */

/* globals console, window, document */

import ClassicEditor from '@ckeditor/ckeditor5-editor-classic/src/classiceditor';
import Alignment from '@ckeditor/ckeditor5-alignment/src/alignment';
import AutoImage from '@ckeditor/ckeditor5-image/src/autoimage';
import CodeBlock from '@ckeditor/ckeditor5-code-block/src/codeblock';
import EasyImage from '@ckeditor/ckeditor5-easy-image/src/easyimage';
import HorizontalLine from '@ckeditor/ckeditor5-horizontal-line/src/horizontalline';
import HtmlEmbed from '@ckeditor/ckeditor5-html-embed/src/htmlembed';
import HtmlComment from '@ckeditor/ckeditor5-html-support/src/htmlcomment';
import ImageResize from '@ckeditor/ckeditor5-image/src/imageresize';
import LinkImage from '@ckeditor/ckeditor5-link/src/linkimage';
import PageBreak from '@ckeditor/ckeditor5-page-break/src/pagebreak';
import SourceEditing from '@ckeditor/ckeditor5-source-editing/src/sourceediting';
import TableCaption from '@ckeditor/ckeditor5-table/src/tablecaption';
import CloudServices from '@ckeditor/ckeditor5-cloud-services/src/cloudservices';
import ImageUpload from '@ckeditor/ckeditor5-image/src/imageupload';
import Essentials from '@ckeditor/ckeditor5-essentials/src/essentials';
import BlockQuote from '@ckeditor/ckeditor5-block-quote/src/blockquote';
import Bold from '@ckeditor/ckeditor5-basic-styles/src/bold';
import Heading from '@ckeditor/ckeditor5-heading/src/heading';
import Image from '@ckeditor/ckeditor5-image/src/image';
import ImageCaption from '@ckeditor/ckeditor5-image/src/imagecaption';
import ImageStyle from '@ckeditor/ckeditor5-image/src/imagestyle';
import ImageToolbar from '@ckeditor/ckeditor5-image/src/imagetoolbar';
import Indent from '@ckeditor/ckeditor5-indent/src/indent';
import Italic from '@ckeditor/ckeditor5-basic-styles/src/italic';
import Link from '@ckeditor/ckeditor5-link/src/link';
import MediaEmbed from '@ckeditor/ckeditor5-media-embed/src/mediaembed';
import Paragraph from '@ckeditor/ckeditor5-paragraph/src/paragraph';
import Table from '@ckeditor/ckeditor5-table/src/table';
import TableToolbar from '@ckeditor/ckeditor5-table/src/tabletoolbar';

import { CS_CONFIG } from '@ckeditor/ckeditor5-cloud-services/tests/_utils/cloud-services-config';

import DocumentList from '../../src/documentlist';
import DocumentListProperties from '../../src/documentlistproperties';
import AdjacentListsSupport from '../../src/documentlist/adjacentlistssupport';

ClassicEditor
	.create( document.querySelector( '#editor' ), {
		...( {
			plugins: [
				Essentials, BlockQuote, Bold, Heading, Image, ImageCaption, ImageStyle, ImageToolbar, Indent, Italic, Link,
				MediaEmbed, Paragraph, Table, TableToolbar, CodeBlock, TableCaption, EasyImage, ImageResize, LinkImage,
				AutoImage, HtmlEmbed, HtmlComment, Alignment, PageBreak, HorizontalLine, ImageUpload,
				CloudServices, SourceEditing,
				DocumentList,
				AdjacentListsSupport,
				DocumentListProperties
			],
			toolbar: [
				'sourceEditing', '|',
				'numberedList', 'bulletedList', '|',
				'outdent', 'indent', '|',
				'heading', '|',
				'bold', 'italic', 'link', '|',
				'blockQuote', 'uploadImage', 'insertTable', 'mediaEmbed', 'codeBlock', '|',
				'htmlEmbed', '|',
				'alignment', '|',
				'pageBreak', 'horizontalLine', '|',
				'undo', 'redo'
			],
			cloudServices: CS_CONFIG,
			placeholder: 'Type the content here!',
			htmlEmbed: {
				showPreviews: true,
				sanitizeHtml: html => ( { html, hasChange: false } )
			}
		} ),
		list: {
			properties: {
				styles: true,
				startIndex: true,
				reversed: true
			}
		}
	} )
	.then( editor => {
		window.editor = editor;
	} )
	.catch( err => {
		console.error( err.stack );
	} );

document.getElementById( 'chbx-show-borders' ).addEventListener( 'change', () => {
	document.body.classList.toggle( 'show-borders' );
} );
