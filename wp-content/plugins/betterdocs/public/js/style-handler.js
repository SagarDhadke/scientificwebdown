// // Update Meta
wp.data.subscribe(() => {
    var isSavingPost = wp.data.select('core/editor').isSavingPost()
    var isAutosavingPost = wp.data.select('core/editor').isAutosavingPost()

    if (isSavingPost && !isAutosavingPost) {
        const post_id = wp.data.select('core/editor').getCurrentPostId()
        const all_blocks = wp.data.select('core/block-editor').getBlocks()

        let styles = {}
        const cssObjectMaker = (blocks) => {
            for (const item of blocks) {
                const { innerBlocks } = item
                if (
                    item.attributes.ref &&
                    typeof item.attributes.ref === 'number'
                ) {
                    const reusableBlock = wp.data
                        .select('core/block-editor')
                        .__experimentalGetParsedReusableBlock(
                            item.attributes.ref
                        )
                    if (
                        Array.isArray(reusableBlock) &&
                        typeof reusableBlock != 'undefined' &&
                        reusableBlock.length > 0
                    ) {
                        reusableBlock.forEach((reusableitem) => {
                            if (
                                reusableitem.attributes.blockMeta &&
                                reusableitem.attributes.blockRoot &&
                                reusableitem.attributes.blockRoot ===
                                    'better_docs'
                            ) {
                                styles = {
                                    ...styles,
                                    ...{
                                        [reusableitem.attributes.blockId]:
                                            reusableitem.attributes.blockMeta,
                                    },
                                }
                            } else if (reusableitem.innerBlocks.length > 0) {
                                cssObjectMaker(reusableitem.innerBlocks)
                            }
                        })
                    }
                } else if (
                    item.attributes.blockMeta &&
                    item.attributes.blockRoot &&
                    item.attributes.blockRoot === 'better_docs'
                ) {
                    styles = {
                        ...styles,
                        ...{
                            [item.attributes.blockId]:
                                item.attributes.blockMeta,
                        },
                    }

                    if (item.innerBlocks.length > 0) {
                        cssObjectMaker(innerBlocks)
                    }
                } else if (innerBlocks.length > 0) {
                    cssObjectMaker(innerBlocks)
                }
            }
        }

        cssObjectMaker(all_blocks) // Call function
        jQuery.ajax({
            type: 'POST',
            url: ajaxurl,
            data: {
                data: JSON.stringify(styles),
                id: post_id,
                action: 'better_docs_write_block_css',
                nonce: better_docs_style_handler.sth_nonce,
            },
            error: function (msg) {
                console.log(msg)
            },
        })
    }
})
