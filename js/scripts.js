// Отображение полей при смене типа лица
function editType(type) {
    let personBlocks = document.getElementsByClassName('person_block'),
        orgBlocks = document.getElementsByClassName('organisation_block'),
        allBlocks = [];

    for (let personBlock of personBlocks) {
        allBlocks.push(personBlock);
    }

    for (let orgBlock of orgBlocks) {
        allBlocks.push(orgBlock);
    }

    for (let obj of allBlocks) {
        if (type === 'person') {
            if (obj.classList.contains('person_block')) {
                obj.classList.add('active');
                setDisabled(personBlocks, false);
            } else {
                obj.classList.remove('active');
                setDisabled(orgBlocks, true);
            }
        } else {
            if (obj.classList.contains('organisation_block')) {
                obj.classList.add('active');
                setDisabled(orgBlocks, false);
            } else {
                obj.classList.remove('active');
                setDisabled(personBlocks, true);
            }
        }
    }
}

// Сделать все поля блока неактивными
function setDisabled(blocks, attr) {
    for (let block of blocks) {
        for (let element of block.querySelectorAll('input')) {
            if (attr === true) {
                element.setAttribute('disabled', 'disabled');
            } else {
                element.removeAttribute('disabled');
            }
        }

        // if (attr === true) {
        //     block.querySelector('.form-input').setAttribute('disabled', 'disabled');
        // } else {
        //     block.querySelector('.form-input').removeAttribute('disabled');
        // }
    }
}