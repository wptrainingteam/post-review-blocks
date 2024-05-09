import { __ } from "@wordpress/i18n";
import { InnerBlocks, useBlockProps } from "@wordpress/block-editor";
import "./editor.scss";

const MY_TEMPLATE = [
	["core/post-title", { isLink: true, placeholder: "The Post Title" }],
	["create-block/rating-block", { placeholder: "The Post Title" }],
	["core/post-excerpt", { placeholder: "The pose content..." }],
];

export default function Edit() {
	return <InnerBlocks template={MY_TEMPLATE} templateLock="all" />;
}
