import os

tempList1 = [] #this is for ??== pattern list items
tempList2 = [] #this is for ???w, ???x, ???y, ???z pattern list items
tempList3 = [] #this is for ???0, ???1, ???2, ???3, ???4, ???5 pattern list items
tempList4 = [] #this is for ???= pattern list items
tempList5 = [] #this is for special combination of tempList2 list and tempList3 list

#this is a method for convert binary to string
def binaryToString(binaryMessage):
    binaryValues = binaryMessage.split()

    asciiString = ""

    for binaryValue in binaryValues:
        anInteger = int(binaryValue, 2)

        asciiCharacter = chr(anInteger)

        asciiString += asciiCharacter

    return asciiString

#get all file names to a list
listOfFiles = os.listdir("./kartaca")

#sort the list with default system algorithm
listOfFiles.sort()

#parse the list items by logical
for file in listOfFiles:
    if file[2] == '=' and file[3] == '=':
        tempList1.append(file)

    elif file[3] == 'w' or file[3] == 'x' or file[3] == 'y' or file[3] == 'z':
        tempList2.append(file)

    elif file[3] == '0' or file[3] == '1' or file[3] == '2' or file[3] == '3' or file[3] == '4' or file[3] == '5':
        tempList3.append(file)

    elif file[3] == '=':
        tempList4.append(file)

#combine the tempList2 list and tempList3 list
#with special combination method in tempList5 list
for i in range(0, len(tempList2) + len(tempList3), 4):
    for j in range(4):
        if (i + j) < len(tempList2):
            tempList5.append(tempList2[i + j])

    for k in range(6):
        if (i + k + int(i/2)) < len(tempList3):
            tempList5.append(tempList3[i + k + int(i/2)])

#sort the file names list with custom algorithm
customSortedFileNamesList = tempList1 + tempList4 + tempList5

#open a file to write decrypted message
decryptedMessageFile = open("./decrypted_message.txt", "w")

#reach files contents and decrypt the message
for fileName in customSortedFileNamesList:
    path = "./kartaca/" + fileName #set path

    file = open(path, "r") #open the file

    #for each file, convert the binary codes to string and write the string to a file 
    decryptedMessageFile.write(binaryToString(file.read()))

#close the opened file
decryptedMessageFile.close()